<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>
    
    
    <style>
        .image-container {
            position: relative;
            display: inline-block;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #ccc;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.3s;
            background-color: rgba(0, 0, 0, 0.5);
            cursor: pointer;
        }

        .trash-image {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40px;
            height: 40px;
            display: none;
        }

        #current-profile-picture {
            width: 200px; /* Adjust the width as needed */
            height: 200px; /* Adjust the height as needed */
        }

        .image-container:hover .overlay {
            opacity: 1;
        }

        .image-container:hover .trash-image {
            display: block;
        }

        .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
        }
    </style>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <!-- Update profile picture -->
        <div>
            <x-input-label for="profile_picture" :value="__('Profile Picture')" />
            <input id="profile_picture" name="profile_picture" type="file" class="mt-1 block w-full visually-hidden" />
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
        </div>
        @if ($user->profile_picture)
            <div class="mt-4">
                <div class="image-container">
                    <img src="{{ asset('storage/images/profile_picture/' . $user->profile_picture) }}" alt="Profile Picture" class="w-40 h-40" id="current-profile-picture">
                    <div class="overlay">
                        <img src="{{ asset('storage/images/buttons/trash.png') }}" alt="Trash" class="trash-image" id="trash-icon">
                    </div>
                </div>
            </div>
        @else
            <div class="mt-4">
                <div class="image-container">
                    <img src="{{ asset('storage/images/default.png') }}" alt="Default Picture" class="w-40 h-40" id="current-profile-picture">
                    <div class="overlay">
                        <img src="{{ asset('storage/images/buttons/trash.png') }}" alt="Trash" class="trash-image" id="trash-icon">
                    </div>
                </div>
            </div>
        @endif
        <input type="hidden" name="remove_image" id="remove_image" value="false">
        <!-- Update name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <!-- Update Description -->
        <div>
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" name="description" class="mt-1 block w-full rounded-md shadow-sm border-gray-300" rows="4" required autofocus autocomplete="description">{{ $user->description }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>
        
        
        


        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const trashIcon = document.getElementById('trash-icon');
    const currentPicture = document.getElementById('current-profile-picture');

    let removeImage = true; // Boolean variable to track if the image should be removed

    trashIcon.addEventListener('click', function() {
    if (removeImage) {
        currentPicture.src = "{{ asset('storage/images/profile_picture/default.png') }}";
        removeImage = false;
        document.getElementById('remove_image').value = 'true';
    } else {
        document.getElementById('profile_picture').click();
        removeImage = true;
        document.getElementById('remove_image').value = 'false';
    }
});


    // Optional: Listen for changes in the file input to update the image accordingly
    document.getElementById('profile_picture').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function() {
            currentPicture.src = reader.result;
        }
        reader.readAsDataURL(file);
    });

});
 

</script>