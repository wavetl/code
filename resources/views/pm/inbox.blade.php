@extends('layouts.code')
@section('main')
    <div class="card">
        <div class="card-header">
            <span><i class="fa fa-comment"></i> {{ __('pm.InBox') }}</span>
        </div>
        <div class="card-body">
            <ul>
                @foreach($pm_list as $pm)
                    @if($pm->is_read)
                        <li><a class="text-muted" href="{{ route('pm_show',['id' => $pm->id]) }}">[已读] {{ $pm->sender->name }}
                                给您发送了一条私信。</a> <span class="text-secondary float-right"><i class="fa fa-clock-o"></i> {{ $pm->created_at->diffForHumans() }}</span>
                        </li>
                    @else
                        <li><a href="{{ route('pm_show',['id' => $pm->id]) }}">[未读] {{ $pm->sender->name }}
                                给您发送了一条私信。</a> <span class="text-secondary float-right"><i class="fa fa-clock-o"></i> {{ $pm->created_at->diffForHumans() }}</span>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endsection