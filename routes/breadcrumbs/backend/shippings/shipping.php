<?php

Breadcrumbs::for('admin.shippings.index', function ($trail) {
    $trail->push(__('labels.backend.access.shippings.management'), route('admin.shippings.index'));
});

Breadcrumbs::for('admin.shippings.create', function ($trail) {
    $trail->parent('admin.shippings.index');
    $trail->push(__('labels.backend.access.shippings.management'), route('admin.shippings.create'));
});

Breadcrumbs::for('admin.shippings.edit', function ($trail, $id) {
    $trail->parent('admin.shippings.index');
    $trail->push(__('labels.backend.access.shippings.management'), route('admin.shippings.edit', $id));
});

Breadcrumbs::for('admin.shippings.show', function ($trail,$order) {
    $trail->parent('admin.shippings.index');
    $trail->push(__('labels.backend.access.shippings.management'), route('admin.shippings.show',$order));
});

