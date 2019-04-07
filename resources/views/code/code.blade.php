<div class="card mb-3">
    <div class="card-header">
        <a href="{{ route('code_view',['slug' => $code->slug,'id' => $code->id]) }}"><i
                    class="fa fa-code mr-1"></i> {{ $code->subject
                        }}</a>
        @if($code->is_author())
            <div class="float-right">
                <a class="btn btn-outline-success btn-sm text-success"
                   href="{{ route('code_edit',['id' => $code->id]) }}"><i
                            class="fa fa-edit"></i> </a>
                <button class="btn btn-outline-danger btn-sm" @click="deleteCode({{ $code->id }})"><i
                            class="fa fa-trash"></i></button>
            </div>
        @endif
    </div>
    <div class="card-body code-body">
        <code_view :language="'{{ $code->language }}'">{{ $code->code }}</code_view>
    </div>
    <div class="card-footer">
        {!!  app('code')::$iconMapping[$code->language] !!}
        <span class="text-secondary"><i class="fa fa-user-alt"></i> <a
                    class="text-secondary" href="{{ route('user_info',['id' => $code->user_id]) }}">{{ $code->user->name }}</a> 分享于 {{ $code->created_at }}</span>
        <button class="btn btn-secondary-outline btn-sm float-right ml-1" data-toggle="tooltip" data-placement="bottom" data-original-title="0 人点赞"><i class="far fa-thumbs-up"></i> 0
        </button>
    </div>
</div>