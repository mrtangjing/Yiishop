<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
<!--                <p>Alexander Pierce</p>-->

<!--                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
            </div>
        </div>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id,null, function($menu){
                    $data = json_decode($menu['data'], true);
                    $items = $menu['children'];
                    $return = [
                        'label' => $menu['name'],
                        'url' => [$menu['route']],
                        ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']]
                    ];

                    //处理我们的配置
                    if ($data) {
                        //visible
                        isset($data['visible']) && $return['visible'] = $data['visible'];
                        //icon
                        isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon'];
                        //other attribute e.g. class...
                        $return['options'] = $data;
                    }
                    //没配置图标的显示默认图标，默认图标大家可以自己随便修改
                    (!isset($return['icon']) || !$return['icon']) && $return['icon'] = 'circle-o';
                    $items && $return['items'] = $items;
                    return $return;
                }),


            ]

        )?>

    </section>

</aside>
