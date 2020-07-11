@if (count($blogs) > 0)
    @foreach($blogs as $blog)
        <div class="col-lg-12">
            <div class="blog-post">
                <div class="blog-thumb">
                    <img src="{{$blog->image}}" alt="">
                </div>
                <div class="down-content">
                    <a href="javascript:void(0)"><h4>{{$blog->title}}</h4></a>
                    <ul class="post-info">
                        <li>
                            <a href="javascript:void(0)">{{isset($blog->creator->name) ? $blog->creator->name:''}}</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">{{date('d M Y', strtotime($blog->created_at))}}</a>
                        </li>
                    </ul>
                    <p>{!! $blog->description !!}</p>
                    @php
                        $categories_names = \Illuminate\Support\Facades\DB::selectOne("SELECT GROUP_CONCAT(c.name SEPARATOR ' | ') as categories_name from blog_to_categories btc, blogs b, categories c WHERE btc.blog_id = b.id and btc.category_id = c.id and b.id = $blog->id");
                    @endphp
                    @if(isset($categories_names->categories_name))
                        <div class="post-options">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="post-tags">
                                        <li><i class="fa fa-tags"></i></li>
                                        <li>
                                            <a href="javascript:void(0)">{{$categories_names->categories_name}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-lg-12">
        <div class="blog-post">
            < Blogs not available for selected dates >
        </div>
    </div>
@endif