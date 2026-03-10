<?php

namespace App\Http\Controllers;

use App\Actions\UpdateTradeSettings;
use App\Http\Requests\TradeSettings;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Throwable;

class TradeSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('TradeSettings', [
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TradeSettings $request): RedirectResponse
    {
        $validated = $request->validated();
        try {
            UpdateTradeSettings::handle($validated);
            return back()->with('success', 'Settings are saved successfully');
        } catch (Throwable $e) {
            report($e);
            return back()->withInput()->withErrors(['settings' => 'Unable to save settings right now. Please Try Again.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
