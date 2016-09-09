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

use Modules\Core\Composers\CurrentUserViewComposer;
use Modules\Core\Composers\MasterViewComposer;
use Modules\Core\Composers\SidebarViewCreator;
use Modules\Core\Composers\ThemeComposer;

view()->creator('partials.sidebar-nav', SidebarViewCreator::class);
view()->composer('layouts.master', MasterViewComposer::class);
view()->composer('core::fields.select-theme', ThemeComposer::class);
view()->composer('layouts.master', CurrentUserViewComposer::class);
