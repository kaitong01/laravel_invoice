<?php

$navs = array();

$items = array();
$items[] = array('id'=>'/contacts', 'name'=>'รายชื่อติดต่อ', 'icon' => '<svg width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"></path><path d="M12 6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2m0 10c2.7 0 5.8 1.29 6 2H6c.23-.72 3.31-2 6-2m0-12C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 10c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>');
$items[] = array('id'=>'/guide', 'name'=>'รายการใบสำคัญจ่าย', 'icon' => '<i class="fas fa-file-invoice-dollar"></i></path></svg>');
// $items[] = array('id'=>'/invoice', 'name'=>'รายการใบสำคัญจ่าย', 'icon' => '<i class="fas fa-file-invoice-dollar"></i></path></svg>');
$navs[] = array('title'=>'', 'items'=>$items);

$items = array();
// $items[] = array('id'=>'/guide', 'name'=>'รายการใบสำคัญจ่าย', 'icon' => '<i class="fas fa-file-invoice-dollar"></i></path></svg>');
$items[] = array('id'=>'/guide/invoice', 'name'=>'ใบสำคัญจ่าย', 'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" class="NSy2Hd RTiFqe null"><path fill="none" d="M0 0h24v24H0V0z"></path><path d="M13 3c-4.97 0-9 4.03-9 9H1l4 3.99L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42C8.27 19.99 10.51 21 13 21c4.97 0 9-4.03 9-9s-4.03-9-9-9zm-1 5v5l4.25 2.52.77-1.28-3.52-2.09V8z"></path></svg>');
$navs[] = array('title'=>'guide', 'items'=>$items);





foreach ($navs as $val) {


    echo '<ul class="navbar-nav navbar-sidenav page-navigation-sidenav">';
    if( !empty($val['title']) ){

        echo '<li class="nav-item head"><span>'.$val['title'].'</span></li>';
    }

    foreach ($val['items'] as $key => $value) {

        //
    ?>
    <li class="nav-item{{request()->is( trim($value['id'],'/'), trim($value['id'],'/').'/*' )? ' active':''}}">
        <a class="nav-link" href="<?=$value['id']?>">
            <span class="nav-link-icon"><?=$value['icon']?></span>
            <span class="nav-link-text"><?=$value['name']?></span>
        </a>
    </li>
    <?php }


    echo '</ul>';
} ?>



