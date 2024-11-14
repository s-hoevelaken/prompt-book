<?php

 namespace Illuminate\Contracts\View;

 use Illuminate\Contracts\Support\Renderable;

 interface View extends Renderable
 {
     /** @return static */
     public function extends();
     public function layoutData();
     public function layout($viewName);
 }