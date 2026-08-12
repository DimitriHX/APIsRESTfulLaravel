<?php

namespace App\Http\Controllers;

use App\Services\MenuItemService;
use Illuminate\Contracts\View\View;

class MenuViewController extends Controller
{
    protected MenuItemService $service;

    public function __construct(MenuItemService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        $menuItems = $this->service->getAllMenuItems();
        return view('menu.index', compact('menuItems'));
    }
}
