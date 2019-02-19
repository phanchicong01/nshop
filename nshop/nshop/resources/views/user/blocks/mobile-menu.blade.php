<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 11-Dec-16
 * Time: 16:45
 */
?>
<?php
$data = \App\Models\Category::select('id', 'name', 'alias', 'id_parent')->where('status', 1)->get()->toArray();
?>
<div class="mobile-menu-area visible-xs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul>
                            <li><a href="{!! route('index') !!}">Home</a>
                            </li>
                            @foreach($data as $item)
                                @if($item['id_parent'] == 0)
                                    <li><a>{!! $item['name'] !!}</a>
                                        <ul>
                                            @foreach($data as $item_child1)
                                            @if($item_child1['id_parent'] == $item['id'])
                                                <li>
                                                    <a  href="{!! route('getCategory', ['id' => $item_child1['id'], 'slug' => $item_child1['alias']]) !!}">     {!! $item_child1['name'] !!}
                                                    </a>
                                                    <ul>
                                                        @foreach($data as $item_child2)
                                                            @if($item_child2['id_parent'] == $item_child1['id'])
                                                                <li>
                                                                    <a href="{!! route('getCategory', ['id' => $item_child2['id'], 'slug' => $item_child2['alias']]) !!}">{!! $item_child2['name'] !!}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                             @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                            <li><a href="{!! route("getNews") !!}">Tin Tức</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
