@extends('layouts.app')

@section('title', __('User Management'))

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black tracking-tight" style="color: var(--text-primary);">{{ __('Users') }}</h1>
            <p class="text-sm opacity-60" style="color: var(--text-secondary);">{{ __('Manage your application users and their roles.') }}</p>
        </div>
    </div>

    <x-card variant="solid" padding="p-0" class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b" style="border-color: var(--border-color); background-color: var(--bg-secondary);">
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest" style="color: var(--text-secondary);">{{ __('User') }}</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest" style="color: var(--text-secondary);">{{ __('Role') }}</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest" style="color: var(--text-secondary);">{{ __('Status') }}</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest" style="color: var(--text-secondary);">{{ __('Joined') }}</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-right" style="color: var(--text-secondary);">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y" style="border-color: var(--border-color);">
                    @foreach($users as $user)
                    <tr class="hover:bg-[var(--bg-input)]/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $user->profile_picture_url }}" class="w-10 h-10 rounded-xl object-cover border" style="border-color: var(--border-color);">
                                <div>
                                    <p class="text-sm font-bold" style="color: var(--text-primary);">{{ $user->name }}</p>
                                    <p class="text-xs opacity-60" style="color: var(--text-secondary);">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.users.role', $user) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('PUT')
                                <select name="role" onchange="this.form.submit()" 
                                        class="text-xs font-bold px-2 py-1 rounded-lg border bg-transparent focus:outline-none"
                                        style="border-color: var(--border-color); color: var(--text-primary);">
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.users.status', $user) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()" 
                                        class="text-xs font-bold px-2 py-1 rounded-lg border bg-transparent focus:outline-none @if($user->status === 'banned') text-red-500 @elseif($user->status === 'frozen') text-amber-500 @else text-emerald-500 @endif"
                                        style="border-color: var(--border-color);">
                                    <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="frozen" {{ $user->status === 'frozen' ? 'selected' : '' }}>Frozen</option>
                                    <option value="banned" {{ $user->status === 'banned' ? 'selected' : '' }}>Banned</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-sm opacity-60" style="color: var(--text-secondary);">
                            {{ $user->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if(!$user->isAdmin())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-500 hover:bg-red-500/10 rounded-lg transition-colors">
                                        <i class="bx bx-trash text-lg"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="px-6 py-4 border-t" style="border-color: var(--border-color);">
                {{ $users->links() }}
            </div>
        @endif
    </x-card>
</div>
@endsection
