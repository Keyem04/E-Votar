<div x-data="{ open: false }" x-cloak @system-user-updated.window="open = false">
    <!-- Trigger Button -->
    <button @click="open = true"
            class="bg-white border border-gray-100 rounded p-1 w-[30px] flex-row  items-center justify-items-center">
        <svg width="14" height="18" viewBox="0 0 17 17" fill="none"
             xmlns="http://www.w3.org/2000/svg">
            <path
                d="M1.49997 15.5H2.7615L12.9981 5.2634L11.7366 4.00188L1.49997 14.2385V15.5ZM0.90385 17C0.647767 17 0.433108 16.9133 0.259875 16.7401C0.0866248 16.5668 0 16.3522 0 16.0961V14.3635C0 14.1196 0.0467999 13.8871 0.1404 13.6661C0.233983 13.4451 0.362825 13.2526 0.526925 13.0885L13.1904 0.430775C13.3416 0.293426 13.5086 0.187292 13.6913 0.112375C13.874 0.0374582 14.0656 0 14.2661 0C14.4666 0 14.6608 0.0355838 14.8488 0.10675C15.0368 0.1779 15.2032 0.291034 15.348 0.44615L16.5692 1.68268C16.7243 1.82754 16.8349 1.99424 16.9009 2.18278C16.9669 2.37129 17 2.55981 17 2.74833C17 2.94941 16.9656 3.14131 16.8969 3.32403C16.8283 3.50676 16.719 3.67373 16.5692 3.82495L3.91147 16.473C3.74738 16.6371 3.55483 16.766 3.33383 16.8596C3.11281 16.9532 2.88037 17 2.6365 17H0.90385ZM12.3563 4.6437L11.7366 4.00188L12.9981 5.2634L12.3563 4.6437Z"
                fill="#35353A"/>
        </svg>

    </button>
    <!-- Modal -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
    >
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            class="bg-white p-6 rounded shadow-md w-2/5"
        >

            <div class="flex justify-between items-center mb-4 border-b border-gray-300 pb-2">
                <div>
                    <h2 class="text-sm font-bold text-left w-full sm:w-auto">Edit System User</h2>
                    <p class="text-[10px] text-gray-500 italic">To edit an election please fill out the required
                        information.</p>
                </div>

                <!-- Close Button (X) -->
                <button @click="open = false" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- System User Details-->
            @if ($currentStep === 1)
                <form wire:submit.prevent="proceedToAccessRole">
                    <div>
                        <div class="flex space-x-4">
                            <div class="w-full">
                                <div class="mb-3 relative w-full"
                                     x-data="{ isOpen: false }">
                                    <label for="candidate_name" class="text-[10px] text-left font-normal block mb-1">
                                        Name of User
                                        <span class="text-[10px] font-light italic">
                                            <a href="{{ route('admin.unregistered.admin') }}"
                                               class="underline text-red-500">(Please click here if user is not a registered voter).
                                            </a>
                                        </span>
                                    </label>
                                    <input
                                        type="text"
                                        id="candidate_name"
                                        placeholder="Search for a user"
                                        class="border border-gray-300 text-xs rounded-lg px-4 py-2 w-full"
                                        wire:model.live="search"
                                        x-on:focus="isOpen = true"
                                        x-on:blur="setTimeout(() => isOpen = false, 200)"
                                        autocomplete="off"
                                        readonly
                                    />
                                    <div x-show="isOpen && search.length > 0" @click.away="isOpen = false"
                                         class="flex z-10 bg-white border border-gray-300 rounded-lg w-full max-h-[50px] overflow-auto mt-[5px] shadow-lg">
                                        <div class="w-full">
                                            @if (!empty($users))
                                                @forelse ($users as $user)
                                                    <div
                                                        class="px-4 py-2 hover:bg-gray-100 cursor-pointer"
                                                        wire:click="selectUser({{ $user->id }})"
                                                        x-on:click="isOpen = false"
                                                    >
                                                        {{ $user->first_name }} {{ $user->middle_initial }}
                                                        . {{ $user->last_name }}
                                                        - {{ $user->year_level }} {{ $user->program->name }}
                                                    </div>
                                                @empty
                                                    <li class="px-4 py-2 text-gray-500">No results found.</li>
                                                @endforelse
                                            @endif
                                        </div>
                                    </div>

                                    @error('selectedUser')
                                    <span class="text-red-500 text-[10px] italic">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 relative w-full">
                                    <p class="text-[12px] text-left font-semibold my-2">Account Information</p>
                                    <div class="flex-1 mb-3">
                                        <label for="username"
                                               class="text-[10px] text-left font-natural px-2 block ">Username</label>
                                        <input type="text" name="username" wire:model="username"
                                               class="border border-gray-300 text-xs rounded-lg px-4 py-2 w-full"
                                               readonly>
                                        @error('username')
                                        <span class="text-red-500 text-[10px] italic">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 relative w-full">
                                    <p class="text-[12px] text-left font-semibold my-2">Account Status</p>
                                    <div class="flex justify-start">
                                        <div class="flex-1 text-left mb-3">
                                            <p class="text-green-500">This Account is Active</p>
                                        </div>

                                        <button class="p-2 text-red-500 rounded">
                                            <p>Deactivate Account</p>
                                        </button>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="mt-6 pt-3 flex justify-end space-x-2">
                            <button type="button"
                                    class="bg-gray-300 text-gray-700 text-[12px] h-7 px-4 py-1 rounded shadow-md hover:bg-gray-400 justify-center text-center"
                                    @click="open = false">
                                Cancel
                            </button>
                            <button type="submit"
                                    class="bg-black text-white px-6 py-1 h-7 rounded shadow-md hover:bg-gray-700 text-[12px] justify-center text-center">
                                Proceed to Access Role and Permission
                            </button>
                        </div>
                    </div>
                </form>
            @elseif($currentStep === 2)
                <form wire:submit.prevent="submit">
                    <div>
                        <div>
                            <div class="mb-2">
                                <p class="text-left">Access Role and Permission</p>
                            </div>
                            <div>
                                <div class="min-h-full overflow-y-auto">
                                    <div class="mb-3">
                                        <select wire:model.live="selectedRole"
                                                class="border border-gray-300 text-xs rounded-lg px-4 py-2 w-full">
                                            <option value="">Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <div>
                                            <h3 class="font-bold mb-4">Assign Permissions</h3>

                                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                                <!-- Election Management Section -->
                                                <div class="flex-1">
                                                    <div class="flex flex-col items-start">
                                                        <h4 class="font-bold text-[11px] mb-2">Election Management</h4>
                                                        <div class="grid grid-cols-1 gap-2">
                                                            @foreach ($permissions as $permission)
                                                                @if (in_array($permission->name, ['view election', 'create election', 'edit election', 'delete election', 'view election results', 'view vote tally']))
                                                                    <div class="flex items-center">
                                                                        <input
                                                                            type="checkbox"
                                                                            id="permission_{{ $permission->id }}"
                                                                            value="{{ $permission->name }}"
                                                                            @if ($userPermissions->contains('name', $permission->name) || $rolePermissions->contains('name', $permission->name)) checked
                                                                            @endif
                                                                            wire:change="togglePermission('{{ $permission->name }}')"
                                                                            class="mr-2"
                                                                        >
                                                                        <label for="permission_{{ $permission->id }}"
                                                                               class="text-[11px]">
                                                                            {{ $permission->name }}
                                                                            @if ($rolePermissions->contains('name', $permission->name))
                                                                                <span class="text-[11px] text-gray-500">(via role)</span>
                                                                            @endif
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End of Election Management Section -->

                                                <!-- Candidate Management Section -->
                                                <div class="flex-1">
                                                    <div class="flex flex-col items-start">
                                                        <h4 class="font-bold mb-2 text-[11px]">Candidate Management</h4>
                                                        <div class="grid grid-cols-1 gap-2">
                                                            @foreach ($permissions as $permission)
                                                                @if (in_array($permission->name, ['create candidate', 'edit candidate', 'delete candidate', 'view candidate']))
                                                                    <div class="flex items-center">
                                                                        <input
                                                                            type="checkbox"
                                                                            id="permission_{{ $permission->id }}"
                                                                            value="{{ $permission->name }}"
                                                                            @if ($userPermissions->contains('name', $permission->name) || $rolePermissions->contains('name', $permission->name)) checked
                                                                            @endif
                                                                            wire:change="togglePermission('{{ $permission->name }}')"
                                                                            class="mr-2"
                                                                        >
                                                                        <label for="permission_{{ $permission->id }}"
                                                                               class="text-[11px]">
                                                                            {{ $permission->name }}
                                                                            @if ($rolePermissions->contains('name', $permission->name))
                                                                                <span class="text-[11px] text-gray-500">(via role)</span>
                                                                            @endif
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End of Candidate Management Section -->

                                                <!-- Party List Management Section -->
                                                <div class="flex-1">
                                                    <div class="flex flex-col items-start">
                                                        <h4 class="font-bold text-[11px] mb-2">Party List
                                                            Management</h4>
                                                        <div class="grid grid-cols-1 gap-2">
                                                            @foreach ($permissions as $permission)
                                                                @if (in_array($permission->name, ['view party list', 'create party list', 'edit party list', 'delete party list']))
                                                                    <div class="flex items-center">
                                                                        <input
                                                                            type="checkbox"
                                                                            id="permission_{{ $permission->id }}"
                                                                            value="{{ $permission->name }}"
                                                                            @if ($userPermissions->contains('name', $permission->name) || $rolePermissions->contains('name', $permission->name)) checked
                                                                            @endif
                                                                            wire:change="togglePermission('{{ $permission->name }}')"
                                                                            class="mr-2"
                                                                        >
                                                                        <label for="permission_{{ $permission->id }}"
                                                                               class="text-[11px]">
                                                                            {{ $permission->name }}
                                                                            @if ($rolePermissions->contains('name', $permission->name))
                                                                                <span class="text-[11px] text-gray-500">(via role)</span>
                                                                            @endif
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End of Party List Management Section -->

                                                <!-- Voter Management Section -->
                                                <div class="flex-1">
                                                    <div class="flex flex-col items-start">
                                                        <h4 class="font-bold text-[11px] mb-2">Voter Management</h4>
                                                        <div class="grid grid-cols-1 gap-2">
                                                            @foreach ($permissions as $permission)
                                                                @if (in_array($permission->name, ['view voter', 'create voter', 'edit voter', 'delete voter']))
                                                                    <div class="flex items-center">
                                                                        <input
                                                                            type="checkbox"
                                                                            id="permission_{{ $permission->id }}"
                                                                            value="{{ $permission->name }}"
                                                                            @if ($userPermissions->contains('name', $permission->name) || $rolePermissions->contains('name', $permission->name)) checked
                                                                            @endif
                                                                            wire:change="togglePermission('{{ $permission->name }}')"
                                                                            class="mr-2"
                                                                        >
                                                                        <label for="permission_{{ $permission->id }}"
                                                                               class="text-[11px]">
                                                                            {{ $permission->name }}
                                                                            @if ($rolePermissions->contains('name', $permission->name))
                                                                                <span class="text-[11px] text-gray-500">(via role)</span>
                                                                            @endif
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End of Voter Management Section -->

                                                <!-- User Management Section -->
                                                <div class="flex-1">
                                                    <div class="flex flex-col items-start">
                                                        <h4 class="font-bold text-[11px] mb-2">User Management</h4>
                                                        <div class="grid grid-cols-1 gap-2">
                                                            @foreach ($permissions as $permission)
                                                                @if (in_array($permission->name, ['view users', 'create users', 'edit users', 'delete users']))
                                                                    <div class="flex items-center">
                                                                        <input
                                                                            type="checkbox"
                                                                            id="permission_{{ $permission->id }}"
                                                                            value="{{ $permission->name }}"
                                                                            @if ($userPermissions->contains('name', $permission->name) || $rolePermissions->contains('name', $permission->name)) checked
                                                                            @endif
                                                                            wire:change="togglePermission('{{ $permission->name }}')"
                                                                            class="mr-2"
                                                                        >
                                                                        <label for="permission_{{ $permission->id }}"
                                                                               class="text-[11px]">
                                                                            {{ $permission->name }}
                                                                            @if ($rolePermissions->contains('name', $permission->name))
                                                                                <span class="text-[11px] text-gray-500">(via role)</span>
                                                                            @endif
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End of User Management Section -->

                                                <!-- System Logs Management Section -->
                                                <div class="flex-1">
                                                    <div class="flex flex-col items-start">
                                                        <h4 class="font-bold text-[11px] mb-2">System Logs
                                                            Management</h4>
                                                        <div class="grid grid-cols-1 gap-2">
                                                            @foreach ($permissions as $permission)
                                                                @if (in_array($permission->name, ['view system logs', 'create system logs', 'edit system logs', 'delete system logs']))
                                                                    <div class="flex items-center">
                                                                        <input
                                                                            type="checkbox"
                                                                            id="permission_{{ $permission->id }}"
                                                                            value="{{ $permission->name }}"
                                                                            @if ($userPermissions->contains('name', $permission->name) || $rolePermissions->contains('name', $permission->name)) checked
                                                                            @endif
                                                                            wire:change="togglePermission('{{ $permission->name }}')"
                                                                            class="mr-2"
                                                                        >
                                                                        <label for="permission_{{ $permission->id }}"
                                                                               class="text-[11px]">
                                                                            {{ $permission->name }}
                                                                            @if ($rolePermissions->contains('name', $permission->name))
                                                                                <span class="text-[11px] text-gray-500">(via role)</span>
                                                                            @endif
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End of System Logs Management Section -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3 pt-3 flex justify-end space-x-2">
                                    <button type="button" wire:click="backToStep1"
                                            class="bg-gray-300 text-gray-700 text-[12px] h-7 px-4 py-1 rounded shadow-md hover:bg-gray-400 justify-center text-center">
                                        Back
                                    </button>
                                    <button type="submit"
                                            class="bg-black text-white px-6 py-1 h-7 rounded shadow-md hover:bg-gray-700 text-[12px] justify-center text-center">
                                        Save System User
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
