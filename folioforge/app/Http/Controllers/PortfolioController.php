<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        return view('portfolios.index', [
            'portfolios' => Portfolio::orderByDesc('updated_at')->get(),
        ]);
    }

    public function create()
    {
        return view('portfolios.form', ['portfolio' => new Portfolio]);
    }

    public function store(Request $request)
    {
        $portfolio = Portfolio::create($this->payload($request) + ['template' => 1]);

        return redirect()->route('portfolios.templates', $portfolio)
            ->with('success', 'Saved to the database. Now choose a template.');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('portfolios.form', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $portfolio->update($this->payload($request, $portfolio));

        return redirect()->route('portfolios.preview', $portfolio)
            ->with('success', 'Changes saved.');
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();

        return redirect()->route('portfolios.index')
            ->with('success', 'Portfolio deleted.');
    }

    public function templates(Portfolio $portfolio)
    {
        return view('portfolios.templates', compact('portfolio'));
    }

    public function selectTemplate(Request $request, Portfolio $portfolio)
    {
        $data = $request->validate(['template' => 'required|in:1,2,3']);
        $portfolio->update(['template' => (int) $data['template']]);

        return redirect()->route('portfolios.preview', $portfolio)
            ->with('success', 'Template applied. Your portfolio is ready.');
    }

    public function preview(Request $request, Portfolio $portfolio)
    {
        $template = (int) $request->query('template', $portfolio->template);
        if (! in_array($template, [1, 2, 3], true)) {
            $template = (int) $portfolio->template;
        }

        return view('portfolios.preview', compact('portfolio', 'template'));
    }

    private function payload(Request $request, ?Portfolio $existing = null): array
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'about' => 'required|string|max:5000',
            'skills' => 'nullable|string|max:2000',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'remove_photo' => 'nullable|boolean',
            'education' => 'nullable|array',
            'education.*.*' => 'nullable|string|max:2000',
            'experience' => 'nullable|array',
            'experience.*.*' => 'nullable|string|max:2000',
            'projects' => 'nullable|array',
            'projects.*.*' => 'nullable|string|max:2000',
            'links' => 'nullable|array',
            'links.*.*' => 'nullable|string|max:2000',
        ]);

        $out = [
            'full_name' => trim($data['full_name']),
            'tagline' => trim($data['tagline'] ?? '') ?: null,
            'email' => trim($data['email']),
            'phone' => trim($data['phone']),
            'address' => trim($data['address']),
            'about' => trim($data['about']),
            'skills' => collect(explode(',', $data['skills'] ?? ''))
                ->map(fn ($s) => trim($s))->filter()->unique()->values()->all(),
            'education' => $this->rows($data['education'] ?? [], ['school', 'degree', 'years']),
            'experience' => $this->rows($data['experience'] ?? [], ['role', 'company', 'years', 'description']),
            'projects' => $this->rows($data['projects'] ?? [], ['title', 'link', 'description'], ['link']),
            'links' => collect($this->rows($data['links'] ?? [], ['label', 'url'], ['url']))
                ->filter(fn ($l) => $l['url'] !== '')->values()->all(),
        ];

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $out['photo'] = 'data:'.$file->getMimeType().';base64,'.base64_encode(file_get_contents($file->getRealPath()));
        } elseif ($request->boolean('remove_photo')) {
            $out['photo'] = null;
        }

        return $out;
    }

    private function rows($rows, array $keys, array $urlKeys = []): array
    {
        return collect(is_array($rows) ? $rows : [])
            ->map(function ($row) use ($keys, $urlKeys) {
                $clean = [];
                foreach ($keys as $k) {
                    $v = is_array($row) ? trim((string) ($row[$k] ?? '')) : '';
                    if ($v !== '' && in_array($k, $urlKeys, true) && ! preg_match('#^https?://#i', $v)) {
                        $v = 'https://'.$v;
                    }
                    $clean[$k] = $v;
                }

                return $clean;
            })
            ->filter(fn ($r) => collect($r)->contains(fn ($v) => $v !== ''))
            ->values()
            ->all();
    }
}
