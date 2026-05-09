@extends('layouts.app')

@section('title', __('Profile'))

@section('content')
<div class="space-y-6 max-w-5xl mx-auto" x-data="imageCropper()">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black tracking-tight" style="color: var(--text-primary);">{{ __('Profile Settings') }}</h1>
            <p class="text-sm font-medium opacity-60" style="color: var(--text-secondary);">{{ __('Manage your personal information, security, and account preferences.') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Sidebar Info -->
        <div class="lg:col-span-4 space-y-6">
            <x-card variant="solid" class="text-center">
                <div class="relative inline-block group mb-6">
                    <img src="{{ auth()->user()->profile_picture_url }}" 
                         class="w-32 h-32 rounded-3xl object-cover border-4 shadow-xl mx-auto transition-transform group-hover:scale-[1.02]" 
                         style="border-color: var(--bg-secondary);">
                    <div class="absolute inset-0 rounded-3xl bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer"
                         onclick="openModal('overview-modal')">
                        <i class="bx bx-camera text-3xl text-white"></i>
                    </div>
                </div>
                <h2 class="text-xl font-black tracking-tight" style="color: var(--text-primary);">{{ auth()->user()->name }}</h2>
                <div class="flex items-center justify-center gap-2 mt-1">
                    <span class="text-[10px] font-black uppercase tracking-widest px-2 py-0.5 rounded bg-[var(--accent-color)]/10 text-[var(--accent-color)] border border-[var(--accent-color)]/20">
                        {{ strtoupper(auth()->user()->role) }}
                    </span>
                    <span class="text-[10px] font-black uppercase tracking-widest px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-500 border border-emerald-500/20">
                        {{ strtoupper(auth()->user()->status) }}
                    </span>
                </div>
                <p class="mt-4 text-xs font-medium opacity-60" style="color: var(--text-secondary);">Member since {{ auth()->user()->created_at->format('M Y') }}</p>
            </x-card>

            <x-card variant="solid" class="space-y-4">
                <h4 class="text-xs font-black uppercase tracking-widest opacity-50">{{ __('Quick Links') }}</h4>
                <div class="space-y-2">
                    <a href="#info" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[var(--bg-input)] transition-colors font-bold text-sm" style="color: var(--text-primary);">
                        <i class="bx bx-user text-xl text-[var(--accent-color)]"></i>
                        {{ __('Account Info') }}
                    </a>
                    <a href="#security" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[var(--bg-input)] transition-colors font-bold text-sm" style="color: var(--text-primary);">
                        <i class="bx bx-shield-lock text-xl text-[var(--accent-color)]"></i>
                        {{ __('Security') }}
                    </a>
                </div>
            </x-card>
        </div>

        <!-- Forms -->
        <div class="lg:col-span-8 space-y-8">
            <x-card id="info" variant="solid">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-[var(--accent-color)]/10 flex items-center justify-center">
                        <i class="bx bx-user-circle text-2xl text-[var(--accent-color)]"></i>
                    </div>
                    <h3 class="text-xl font-black tracking-tight" style="color: var(--text-primary);">{{ __('Public Profile') }}</h3>
                </div>

                <form id="profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <input type="file" name="profile_picture" id="profile_picture_input" class="hidden" accept="image/*" @change="handleFile($event)">
                    <input type="hidden" name="cropped_image" x-model="croppedData">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1.5">
                            <label class="text-xs font-black uppercase tracking-widest ml-1" style="color: var(--text-secondary);">{{ __('Full Name') }}</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required 
                                   class="w-full px-4 py-3 rounded-2xl border bg-[var(--bg-input)] focus:ring-2 focus:ring-[var(--accent-color)]/20 transition-all outline-none" 
                                   style="border-color: var(--border-color); color: var(--text-primary);">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-black uppercase tracking-widest ml-1" style="color: var(--text-secondary);">{{ __('Username') }}</label>
                            <input type="text" name="username" value="{{ old('username', auth()->user()->username) }}" required 
                                   class="w-full px-4 py-3 rounded-2xl border bg-[var(--bg-input)] focus:ring-2 focus:ring-[var(--accent-color)]/20 transition-all outline-none" 
                                   style="border-color: var(--border-color); color: var(--text-primary);">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-black uppercase tracking-widest ml-1" style="color: var(--text-secondary);">{{ __('Email Address') }}</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required 
                               class="w-full px-4 py-3 rounded-2xl border bg-[var(--bg-input)] focus:ring-2 focus:ring-[var(--accent-color)]/20 transition-all outline-none" 
                               style="border-color: var(--border-color); color: var(--text-primary);">
                    </div>

                    <div class="flex justify-end pt-4">
                        <x-button type="submit" variant="primary" class="!rounded-2xl px-8 py-3.5 font-black uppercase tracking-widest shadow-xl shadow-[var(--accent-color)]/20">
                            {{ __('Update Profile') }}
                        </x-button>
                    </div>
                </form>
            </x-card>

            <x-card id="security" variant="solid">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 flex items-center justify-center">
                        <i class="bx bx-key text-2xl text-amber-500"></i>
                    </div>
                    <h3 class="text-xl font-black tracking-tight" style="color: var(--text-primary);">{{ __('Security') }}</h3>
                </div>

                <form action="{{ route('profile.password') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-1.5" x-data="{ show: false }">
                        <label class="text-xs font-black uppercase tracking-widest ml-1" style="color: var(--text-secondary);">{{ __('Current Password') }}</label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" name="current_password" required 
                                class="w-full pl-4 pr-12 py-3 rounded-2xl border bg-[var(--bg-input)] focus:ring-2 focus:ring-amber-500/20 transition-all outline-none" 
                                style="border-color: var(--border-color); color: var(--text-primary);">
                            <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-xl opacity-40 hover:opacity-100 transition-opacity">
                                <i class="bx" :class="show ? 'bx-hide' : 'bx-show'"></i>
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1.5" x-data="{ show: false }">
                            <label class="text-xs font-black uppercase tracking-widest ml-1" style="color: var(--text-secondary);">{{ __('New Password') }}</label>
                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" name="password" required 
                                    class="w-full pl-4 pr-12 py-3 rounded-2xl border bg-[var(--bg-input)] focus:ring-2 focus:ring-amber-500/20 transition-all outline-none" 
                                    style="border-color: var(--border-color); color: var(--text-primary);">
                                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-xl opacity-40 hover:opacity-100 transition-opacity">
                                    <i class="bx" :class="show ? 'bx-hide' : 'bx-show'"></i>
                                </button>
                            </div>
                        </div>
                        <div class="space-y-1.5" x-data="{ show: false }">
                            <label class="text-xs font-black uppercase tracking-widest ml-1" style="color: var(--text-secondary);">{{ __('Confirm Password') }}</label>
                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" name="password_confirmation" required 
                                    class="w-full pl-4 pr-12 py-3 rounded-2xl border bg-[var(--bg-input)] focus:ring-2 focus:ring-amber-500/20 transition-all outline-none" 
                                    style="border-color: var(--border-color); color: var(--text-primary);">
                                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-xl opacity-40 hover:opacity-100 transition-opacity">
                                    <i class="bx" :class="show ? 'bx-hide' : 'bx-show'"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <x-button type="submit" variant="secondary" class="!rounded-2xl px-8 py-3.5 font-black uppercase tracking-widest">
                            {{ __('Change Password') }}
                        </x-button>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</div>

<!-- Modal Overview & Crop Moved Out of Main Content Wrapper to fix Blur/Positioning -->
<!-- Overview Modal -->
<x-modal id="overview-modal" :title="__('Profile picture')" size="sm">
    <div class="flex flex-col items-center">
        <div class="py-4 flex justify-center w-full">
            <img src="{{ auth()->user()->profile_picture_url }}" 
                 class="w-48 h-48 sm:w-64 sm:h-64 rounded-full object-cover border-4 shadow-2xl" 
                 style="border-color: var(--bg-card);">
        </div>
    </div>

    <x-slot name="footer">
        <div class="w-full flex flex-col sm:flex-row items-center justify-center gap-3">
            <x-button variant="primary" class="w-full sm:flex-1 !rounded-xl py-3 font-black uppercase tracking-widest" onclick="triggerFileUpload()">
                <i class="bx bx-edit-alt mr-2 text-lg"></i>
                {{ __('Change') }}
            </x-button>
            
            @if(auth()->user()->profile_picture)
                <form action="{{ route('profile.picture.remove') }}" method="POST" class="w-full sm:flex-1">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" variant="outline" class="w-full !rounded-xl py-3 font-black uppercase tracking-widest !text-red-500 !border-red-500/20 hover:!bg-red-500/10">
                        <i class="bx bx-trash mr-2 text-lg"></i>
                        {{ __('Remove') }}
                    </x-button>
                </form>
            @endif
        </div>
    </x-slot>
</x-modal>

<!-- Crop Modal -->
<x-modal id="crop-modal" :title="__('Edit profile picture')" size="lg">
    <div class="space-y-8">
        <div class="bg-[#121212] rounded-2xl flex items-center justify-center min-h-[350px] max-h-[50vh] overflow-hidden border border-white/5">
            <img id="crop-image" class="max-w-full block">
        </div>

        <div class="space-y-4">
            <div class="flex items-center gap-4 max-w-md mx-auto">
                <i class="bx bx-image text-lg opacity-40 text-[var(--text-primary)]"></i>
                <div class="flex-1 relative flex items-center">
                    <input type="range" 
                           id="zoom-slider"
                           min="0.1" max="3" step="0.001"
                           class="w-full h-1 bg-[var(--bg-input)] rounded-full appearance-none cursor-pointer accent-[var(--accent-color)] hover:accent-[var(--accent-color)]/80 transition-all">
                </div>
                <i class="bx bx-image text-2xl opacity-80 text-[var(--text-primary)]"></i>
            </div>

            <div class="flex justify-center gap-4">
                <button onclick="rotateImage(-90)" class="w-10 h-10 rounded-xl flex items-center justify-center border hover:bg-[var(--bg-input)] transition-all text-[var(--text-primary)]" style="border-color: var(--border-color);">
                    <i class="bx bx-rotate-left text-xl"></i>
                </button>
                <button onclick="rotateImage(90)" class="w-10 h-10 rounded-xl flex items-center justify-center border hover:bg-[var(--bg-input)] transition-all text-[var(--text-primary)]" style="border-color: var(--border-color);">
                    <i class="bx bx-rotate-right text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <x-slot name="footer">
        <x-button variant="secondary" onclick="closeModal('crop-modal')" class="!rounded-xl py-2.5 px-6 font-bold text-sm">
            {{ __('Cancel') }}
        </x-button>
        <x-button variant="primary" onclick="performCrop()" class="!rounded-xl py-2.5 px-8 font-bold text-sm shadow-lg shadow-[var(--accent-color)]/30">
            {{ __('Save Changes') }}
        </x-button>
    </x-slot>
</x-modal>

@push('styles')
<style>
    .cropper-container { direction: ltr; font-size: 0; line-height: 0; position: relative; touch-action: none; user-select: none; }
    .cropper-modal { background-color: rgba(0, 0, 0, 0.4) !important; opacity: 1 !important; }
    .cropper-view-box { border-radius: 50%; outline: 2px solid white !important; outline-color: rgba(255, 255, 255, 0.8) !important; }
    .cropper-face { border-radius: 50%; background-color: transparent !important; opacity: 0 !important; }
    .cropper-line, .cropper-point, .cropper-center, .cropper-dashed { display: none !important; }
    .cropper-bg { background-image: none !important; background-color: #1a1a1a !important; }
</style>
@endpush

@push('scripts')
<script>
    let cropper = null;
    let croppedData = '';

    function triggerFileUpload() {
        closeModal('overview-modal');
        document.getElementById('profile_picture_input').click();
    }

    function handleFile(e) {
        const file = e.target.files[0];
        if (!file) return;

        if (file.size > 15 * 1024 * 1024) {
            Swal.fire({ icon: 'error', title: 'File too large', text: 'Please select an image smaller than 15MB.' });
            e.target.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = (event) => {
            const image = document.getElementById('crop-image');
            image.src = event.target.result;
            openModal('crop-modal');
            
            if (cropper) cropper.destroy();
            
            setTimeout(() => {
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    dragMode: 'move',
                    guides: false,
                    center: true,
                    highlight: false,
                    cropBoxMovable: false,
                    cropBoxResizable: false,
                    ready: () => {
                        const face = document.querySelector('.cropper-face');
                        if (face) face.style.borderRadius = '50%';
                        
                        // Link zoom slider
                        const slider = document.getElementById('zoom-slider');
                        slider.value = 1;
                        slider.addEventListener('input', (e) => {
                            cropper.zoomTo(e.target.value);
                        });
                    }
                });
            }, 50);
        };
        reader.readAsDataURL(file);
    }

    function rotateImage(deg) {
        if (cropper) cropper.rotate(deg);
    }

    function performCrop() {
        if (!cropper) return;
        const canvas = cropper.getCroppedCanvas({ width: 800, height: 800 });
        const base64 = canvas.toDataURL('image/webp', 0.8);
        
        // Create a hidden input for the cropped data in the main form and submit
        const form = document.getElementById('profile-form');
        const input = form.querySelector('input[name="cropped_image"]');
        input.value = base64;
        
        closeModal('crop-modal');
        form.submit();
    }

    function imageCropper() {
        return {
            croppedData: '',
            zoomValue: 1,
            handleFile: handleFile
        }
    }
</script>
@endpush
@endsection
