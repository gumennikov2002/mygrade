<?php

namespace App\Http\Controllers;

use App\Data\PortfolioData;
use App\Enums\PortfolioFilter;
use App\Enums\PortfolioStatusFilter;
use App\Models\Portfolio;
use App\Models\User;
use App\Services\PortfolioManagementService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Spatie\LaravelData\Exceptions\InvalidDataClass;

class PortfolioController extends Controller
{
    public function __construct(
        protected PortfolioManagementService $service
    ) {}

    public function index(Request $request): Response
    {
        $user = $request->user();
        $filters = $request->only(PortfolioFilter::asValuesArray());
        $portfolios = $this->service->getPaginatedByUser($user, filters: $filters);

        return inertia('Portfolio/PortfolioList', compact('portfolios', 'filters'));
    }

    public function indexPublic(string $username, string $slug): Response
    {
        $user = User::with('portfolios')
            ->where('username', $username)
            ->firstOrFail();

        $portfolio = $user->portfolios()
            ->filterStatus(PortfolioStatusFilter::ACTIVE)
            ->where('slug', $slug)
            ->with([
                'services' => fn (HasMany $query) => $query->active()->orderBy('sort_order'),
                'links'    => fn (HasMany $query) => $query->active()->orderBy('sort_order'),
                'projects' => fn (HasMany $query) => $query->active()->orderBy('sort_order'),
            ])
            ->firstOrFail();

        return inertia('Portfolio/PortfolioPublicItem', [
            'portfolio' => $portfolio->getData(),
            'user' => $user->getData(),
        ]);
    }

    public function create(): Response
    {
        return inertia('Portfolio/PortfolioItem');
    }

    /**
     * @throws AuthorizationException
     * @throws InvalidDataClass
     */
    public function edit(Portfolio $portfolio): Response
    {
        $this->authorize('update', $portfolio);

        $portfolio->load([
            'services' => fn (HasMany $query) => $query->orderBy('sort_order'),
            'links'    => fn (HasMany $query) => $query->orderBy('sort_order'),
            'projects' => fn (HasMany $query) => $query->orderBy('sort_order'),
        ]);

        return inertia('Portfolio/PortfolioItem', [
            'portfolio' => $portfolio->getData(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->service->create(
            $request->user(),
            PortfolioData::from($request)
        );

        return redirect()->route('portfolios.index');
    }

    public function update(Portfolio $portfolio, Request $request): RedirectResponse
    {
        $this->service->update(
            $portfolio,
            PortfolioData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $portfolio->id
        ]);
    }

    public function destroy(Portfolio $portfolio): void
    {
        $this->service->delete($portfolio);
    }
}
