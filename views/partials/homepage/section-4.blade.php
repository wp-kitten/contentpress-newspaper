{{--
    Style #4
        2 columns, each 5 vertical small posts

    col 1, col 2
        5 x small posts
--}}
@inject('postStatus', 'App\Models\PostStatus')
@php
    /**@var App\Newspaper\NewspaperHelper $newspaperHelper*/
    /**@var App\Models\Post $post */

    $cacheKey = "home-section-4-{$category->id}";
    $posts = $cache->get($cacheKey);
    if( ! $posts ) {
        $posts = $newspaperHelper->clearOutCache()->categoryTreeGetPosts($category, $postStatusID, 10);
        if( ! empty( $posts ) ) {
            $cache->set($cacheKey, $posts);
        }
   }
    $postsLeft = [];
    $postsRight = [];
    if(! empty($posts)){
        $i = 0;
        foreach($posts as $pid => $p){
            if($i > 4){
                $postsRight[$pid] = $p;
            }
            else {
                $postsLeft[$pid] = $p;
            }
            $i++;
        }
    }
@endphp
<div class="row s-4">
    @if(!empty($posts))
        <div class="col-sm-12">
            <section class="section-cat-title mt-3">
                <h3>{!! $category->name !!}</h3>
            </section>
        </div>
    @endif

    @if(! empty($postsLeft))
        <div class="col-sm-12 col-md-6">
            @foreach($postsLeft as $postID => $post)
                <article class="hentry-loop mb-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <header class="hentry-header full-h">
                                {!! $newspaperHelper->getPostImageOrPlaceholder($post, '', 'image-responsive', ['alt' => $post->title]) !!}
                            </header>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <section class="hentry-content">
                                <h4 class="hentry-title @if(!wp_is_mobile()) title-small font-default @endif">
                                    <a href={{vp_get_permalink($post)}} class="text-info">
                                        {!! vp_ellipsis($post->title, 70) !!}
                                    </a>
                                </h4>
                            </section>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
    @if(! empty($postsRight))
        <div class="col-sm-12 col-md-6">
            @foreach($postsRight as $postID => $post)
                <article class="hentry-loop mb-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <header class="hentry-header full-h">
                                {!! $newspaperHelper->getPostImageOrPlaceholder($post, '', 'image-responsive', ['alt' => $post->title]) !!}
                            </header>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <section class="hentry-content">
                                <h4 class="hentry-title @if(!wp_is_mobile()) title-small font-default @endif">
                                    <a href={{vp_get_permalink($post)}} class="text-info">
                                        {!! vp_ellipsis($post->title, 70) !!}
                                    </a>
                                </h4>
                            </section>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</div>
