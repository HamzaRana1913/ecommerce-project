@extends('layouts.admin')
@section('title', 'Administrators')
@section('page_title', 'Administrators')

@section('admin_content')
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-user-shield" style="color:var(--gold);margin-right:0.5rem"></i>Administrators ({{ $admins->count() }})</div>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="adminsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Joined</th>
                    <th>Last Login</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.7rem">
                            <div style="width:36px;height:36px;background:rgba(201,168,76,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;color:var(--gold);font-size:0.85rem;flex-shrink:0">
                                {{ strtoupper(substr($admin->name, 0, 1)) }}
                            </div>
                            <div>
                                <strong>{{ $admin->name }}</strong>
                                @if($admin->id === auth()->id())
                                    <span style="background:rgba(201,168,76,0.15);color:var(--gold);font-size:0.7rem;padding:0.1rem 0.5rem;border-radius:10px;margin-left:0.4rem">You</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>{{ $admin->email }}</td>
                    <td style="font-size:0.85rem;color:var(--text-muted)">{{ $admin->created_at->format('M d, Y') }}</td>
                    <td style="font-size:0.85rem;color:var(--text-muted)">{{ $admin->updated_at->format('M d, Y') }}</td>
                    <td>
                        <span class="badge-status badge-admin">
                            <i class="fas fa-shield-alt" style="margin-right:0.3rem"></i>Administrator
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
