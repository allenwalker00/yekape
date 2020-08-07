<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Auth;
use App\Models\Menus;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        view()->composer('layout', function ($view) {

            if(Auth::user()->nama == 'Administrator'){
                $aa = Menus::where('tipe', '>', 0)->orderBy('urut')->get();
            }else{
                $aa = Menus::where('tipe', '>', 0)
                        ->whereHas('roles.roleuser', function($sql){
                            $sql->where('user_id', Auth::user()->id);
                        })
                        ->orderBy('urut')->get();
            }
            
            
            $html = '';

            //menu sesuai role
            $bef = '';
            foreach($aa as $row){
                // dd($row);
                if($row->tipe == 0){
                    if($bef == 2){
                        $html .= '</ul></div></li>';
                    }
                    $html .= '<li class="kt-menu__item " aria-haspopup="true">
                                <a href="'.route($row->url).'" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon"><i class="'.$row->icon.'"></i></span>
                                    <span class="kt-menu__link-text">'.$row->nama.'</span>
                                </a>
                            </li>';
                    $bef = $row->tipe;
                }elseif($row->tipe == 1){
                    if($bef == 4){
                        $html .= '</ul></div></li></ul></div></li>';
                    }
                    if($bef == 2){
                        $html .= '</ul></div></li>';
                    }
                    $html .= '<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><i class="'.$row->icon.'"></i></span><span class="kt-menu__link-text">'.$row->nama.'</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">'.$row->nama.'</span></span></li>';
                    $bef = $row->tipe;
                }elseif($row->tipe == 3){
                    if($bef == 4){
                        $html .= '</ul></div></li>';
                    }
                    $html .= '<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="kt-menu__link-text">'.$row->nama.'</span>
                                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                </a>
                                <div class="kt-menu__submenu ">
                                    <span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">';
                    $bef = $row->tipe;

                }elseif($row->tipe == 2){
                    // dd($bef);
                    if($bef == 4){
                        $html .= '</ul></div></li>';
                    }
                    $html .= '<li class="kt-menu__item " aria-haspopup="true">
                                <a href="'.route($row->url).'" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="kt-menu__link-text">
                                    '.$row->nama.'
                                    </span>
                                </a>
                            </li>';
                    $bef = $row->tipe;
                }elseif($row->tipe == 4){
                    $html .= '<li class="kt-menu__item " aria-haspopup="true">
                                <a href="'.route($row->url).'" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="kt-menu__link-text">
                                    '.$row->nama.'
                                    </span>
                                </a>
                            </li>';
                    $bef = $row->tipe;
                }
            }
            if($bef == 2){
                $html .= '</ul></div></li>';
            }

            if($bef == 4){
                $html .= '</ul></div></li></ul></div></li>';
            }
            $view->with('menu', $html);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
