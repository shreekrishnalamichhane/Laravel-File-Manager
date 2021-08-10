 <!-- Sidebar-->
 <aside class="col-lg-3 pt-4 pt-lg-0 pe-xl-5 sidebar">
     <div class="component bg-white rounded-3 shadow-lg pt-1 mb-5 mb-lg-0">

         {{-- user profile card --}}
         <div class="d-md-flex justify-content-between align-items-center text-center text-md-start p-4">
             <div class="d-md-flex align-items-center">
                 <div class="img-thumbnail rounded-circle position-relative flex-shrink-0 mx-auto mb-2 mx-md-0 mb-md-0"
                     style="width: 6.375rem;"><img class="rounded-circle cus-avatar-preview"
                         src="/storage/usercontents/avatars/{{ Auth::user()->avatar }}"
                         alt="{{ $data['user']->name }}'s Avatar Image.">
                 </div>
                 <div class="ps-md-3">
                     <h3 class="fs-base mb-0">{{ $data['user']->name }}</h3><span
                         class="text-accent fs-sm">{{ $data['user']->email }}</span>
                 </div>
             </div><a class="btn btn-primary btn-sm d-lg-none mb-2 mt-3 mt-md-0 collapsed" href="#account-menu"
                 data-bs-toggle="collapse" aria-expanded="false"><i class="ci-menu me-2"></i>Account menu</a>
         </div>
         <div class="d-lg-block collapse" id="account-menu" style="">
             <div class="bg-secondary px-4 py-3">
                 <h3 class="fs-sm mb-0 text-muted">File Manager</h3>
             </div>
             <ul class="list-unstyled mb-0">
                 <li class="border-bottom mb-0"><a
                         class="nav-link-style d-flex align-items-center px-4 py-3 {{ activeMenuItem('files') }}"
                         href="{{ route('files.index') }}"><i class="ci-folder opacity-60 me-2"></i>My Files</a>
                 </li>
                 <li class="border-bottom mb-0"><a
                         class="nav-link-style d-flex align-items-center px-4 py-3 {{ activeMenuItem('starred') }}"
                         href="{{ route('files.starred') }}"><i class="ci-star opacity-60 me-2"></i>Starred</a></li>
             </ul>
             <div class="bg-secondary px-4 py-3">
                 <h3 class="fs-sm mb-0 text-muted">Account settings</h3>
             </div>
             <ul class="list-unstyled mb-0">
                 <li class="border-bottom mb-0"><a
                         class="nav-link-style d-flex align-items-center px-4 py-3 {{ activeMenuItem('profile') }}"
                         href="/profile"><i class="ci-user opacity-60 me-2"></i>Profile Settings</a></li>
                 <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="#"
                         onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                             class="ci-sign-out opacity-60 me-2"></i>Sign out</a></li>
             </ul>
         </div>

     </div>
 </aside>
