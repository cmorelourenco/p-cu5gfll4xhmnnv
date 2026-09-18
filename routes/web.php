<?php

use App\Livewire\DesignSystem;
use Illuminate\Support\Facades\Route;

// Placeholder landing page: for now it simply displays the design system.
Route::get('/', DesignSystem::class)->name('home');
Route::get('/design-system', DesignSystem::class)->name('design-system');
