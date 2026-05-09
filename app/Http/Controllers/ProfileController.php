<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show()
    {
        return view('pages.profile.show');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'profile_picture' => ['nullable', 'image', 'max:15360'],
            'cropped_image' => ['nullable', 'string', 'max:2097152'], // ~1.5MB decoded max
        ]);

        if ($request->filled('cropped_image')) {
            $imageData = $request->input('cropped_image');

            // Strip base64 prefix (support multiple image formats)
            $imageData = preg_replace('#^data:image/\w+;base64,#', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $imageBinary = base64_decode($imageData, true);

            if ($imageBinary === false || strlen($imageBinary) > 1572864) {
                return back()->withErrors(['cropped_image' => __('Invalid or oversized image data.')]);
            }

            // Validate that decoded data is actually an image
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($imageBinary);

            if (! in_array($mimeType, ['image/webp', 'image/png', 'image/jpeg', 'image/gif'])) {
                return back()->withErrors(['cropped_image' => __('Invalid image format.')]);
            }

            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $path = 'profile-pictures/' . $user->id . '.webp';
            Storage::disk('public')->put($path, $imageBinary);
            $user->update(['profile_picture' => $path]);
        }

        $user->update([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }

    public function removePicture()
    {
        $user = Auth::user();
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
            $user->update(['profile_picture' => null]);
        }
        return back()->with('success', 'Profile picture removed.');
    }
}
