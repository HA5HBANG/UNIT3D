@extends('layout.default')

@section('title')
    <title>Invites Log - Staff Dashboard - {{ config('other.title') }}</title>
@endsection

@section('meta')
    <meta name="description" content="Invites Log - Staff Dashboard">
@endsection

@section('breadcrumb')
    <li>
        <a href="{{ route('staff_dashboard') }}" itemprop="url" class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">Staff Dashboard</span>
        </a>
    </li>
    <li class="active">
        <a href="{{ route('getInvites') }}" itemprop="url" class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">Invites Log</span>
        </a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block">
            <h2>Invites Log</h2>
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <h2>Invites Sent <span class="text-blue"><strong><i
                                        class="{{ config('other.font-awesome') }} fa-note"></i> {{ $invitecount }} </strong></span></h2>
                    <div class="table-responsive">
                        <table class="table table-condensed table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Sender</th>
                            <th>Email</th>
                            <th>Code</th>
                            <th>Created On</th>
                            <th>Expires On</th>
                            <th>Accepted By</th>
                            <th>Accepted At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($invites) == 0)
                            <p>The are no invite logs in the database for this user!</p>
                        @else
                            @foreach($invites as $invite)
                                <tr>
                                    <td>
                                        <a href="{{ route('profile', ['username' => $invite->sender->username, 'id' => $invite->sender->id]) }}">
                                            <span class="text-bold" style="color: {{ $invite->sender->group->color }}">
                                                <i class="{{ $invite->sender->group->icon }}"></i> {{ $invite->sender->username }}
                                            </span>
                                        </a>
                                    </td>
                                    <td>
                                        {{ $invite->email }}
                                    </td>
                                    <td>
                                        {{ $invite->code }}
                                    </td>
                                    <td>
                                        {{ $invite->created_at }}
                                    </td>
                                    <td>
                                        {{ $invite->expires_on }}
                                    </td>
                                    <td>
                                        @if($invite->accepted_by != null && $invite->accepted_by != 1)
                                            <a href="{{ route('profile', ['username' => $invite->receiver->username, 'id' => $invite->receiver->id]) }}">
                                                <span class="text-bold" style="color: {{ $invite->receiver->group->color }}">
                                                    <i class="{{ $invite->receiver->group->icon }}"></i> {{ $invite->receiver->username }}
                                                </span>
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($invite->accepted_at != null)
                                            {{ $invite->accepted_at }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
            <div class="text-center">
                {{ $invites->links() }}
            </div>
        </div>
    </div>
@endsection
