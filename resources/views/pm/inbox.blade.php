@extends('layouts.user')
@section('main')
    <div class="card mb-3">
        <div class="card-header">
            <span><i class="fa fa-inbox"></i> {{ __('pm.InBox') }}</span>
        </div>
        <div class="card-body">
            @if($pm_list->count() === 0)
                <div class="text-center">私信列表为空</div>
            @else
                <ul>
                    @foreach($pm_list as $pm)
                        @if($pm->is_read)
                            <li><a class="text-muted"
                                   href="{{ route('pm_show',['id' => $pm->id]) }}">[已读] {{ $pm->sender->name }}
                                    给您发送了一条私信。</a> <span class="text-secondary float-right"><i
                                            class="fa fa-clock-o"></i> {{ $pm->created_at->diffForHumans() }}</span>
                            </li>
                        @else
                            <li><a href="{{ route('pm_show',['id' => $pm->id]) }}">[未读] {{ $pm->sender->name }}
                                    给您发送了一条私信。</a> <span class="text-secondary float-right"><i
                                            class="fa fa-clock-o"></i> {{ $pm->created_at->diffForHumans() }}</span>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection