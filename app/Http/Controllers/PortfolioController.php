<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        return view('portfolio.index', [
            'profile' => config('portfolio'),
            'projects' => config('portfolio.projects'),
            'skills' => config('portfolio.skills'),
        ]);
    }

    public function show(string $slug): View
    {
        $project = collect(
            config('portfolio.projects')
        )->firstWhere('slug', $slug);

        abort_unless($project, 404);

        return view('projects.show', [
            'project' => $project,
        ]);
    }
}
