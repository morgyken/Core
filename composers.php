<?php

/*
 * =============================================================================
 *
 * Collabmed Solutions Ltd
 * Project: Collabmed Health Platform
 * Author: Samuel Okoth <sodhiambo@collabmed.com>
 *
 * =============================================================================
 */

use Ignite\Core\Composers\CurrentUserViewComposer;
use Ignite\Core\Composers\DashboardWidgetViewComposer;
use Ignite\Core\Composers\MasterViewComposer;
use Ignite\Core\Composers\MigrateViewComposer;
use Ignite\Core\Composers\SidebarViewCreator;
use Ignite\Core\Composers\ThemeComposer;

view()->creator('partials.sidebar-nav', SidebarViewCreator::class);
view()->composer('layouts.app', MasterViewComposer::class);
view()->composer('core::fields.select-theme', ThemeComposer::class);
view()->composer('layouts.app', CurrentUserViewComposer::class);
view()->composer('dashboard::dashboard', DashboardWidgetViewComposer::class);
view()->composer(['core::workbench.tabs.migrate', 'core::workbench.tabs.seed',], MigrateViewComposer::class);

