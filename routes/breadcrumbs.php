<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin-dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('admin-dashboard', route('admin-dashboard'));
});
Breadcrumbs::for('add-event', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('add-event', route('add-event'));
});
Breadcrumbs::for('event-list', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('event-list', route('event-list'));
});
Breadcrumbs::for('edit', function (BreadcrumbTrail $trail ,$slug) {
    $trail->parent('event-list');
    $trail->push($slug, route('event-edit',['slug'=>$slug]));
});

Breadcrumbs::for('register-list',function (BreadcrumbTrail $trail ,$slug){
    $trail->parent('event-list');
    $trail->push($slug,route('register-list',['slug'=>$slug]));
})


?>