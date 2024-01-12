<?php

namespace Themsaid\CashierTool;

use Illuminate\Http\Request;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class CashierTool extends Tool
{
    /**
     * Perform any tasks that need to happen on tool registration.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::script('nova-cashier-tool', __DIR__ . '/../dist/js/tool.js');
        Nova::style('nova-cashier-tool', __DIR__ . '/../dist/css/tool.css');
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View|string
     */
    public function renderNavigation()
    {
        return view('nova-cashier-tool::navigation');
    }

    /**
     * Get the displayable name of the tool.
     *
     * @return string
     */
    public function name()
    {
        return __('Cashier Manager');
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function menu(Request $request)
    {
        return [
            (new CashierResourceTool)->canSee(function ($request) {
                return $request->user()->can('manage cashier');
            }),
        ];
    }
}
