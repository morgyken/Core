<?php foreach ($changelog['versions'] as $version => $info): ?>
    <dl class="dl-horizontal">
        <dt><a href="{{ $changelog['url'].'/downloads?tab=tags&tag='.$version }}" target="_blank"><i class="fa fa-external-link-square"></i> {{ $version }}</a></dt>
        <dd>
            <?php if (isset($info['added'])): ?>
                @include('core::modules.partials.changelog-part', [
                'title' => 'Added',
                'label' => 'success',
                'color' => 'green',
                'data' => $info['added']
                ])
            <?php endif; ?>
            <?php if (isset($info['changed'])): ?>
                @include('core::modules.partials.changelog-part', [
                'title' => 'Changed',
                'label' => 'warning',
                'color' => 'orange',
                'data' => $info['changed']
                ])
            <?php endif; ?>
            <?php if (isset($info['removed'])): ?>
                @include('core::modules.partials.changelog-part', [
                'title' => 'Removed',
                'label' => 'danger',
                'color' => 'red',
                'data' => $info['removed']
                ])
            <?php endif; ?>
        </dd>
    </dl>
    <?php
endforeach;
