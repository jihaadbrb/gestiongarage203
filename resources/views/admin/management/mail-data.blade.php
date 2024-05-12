@extends('admin.layouts.home')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ __('Inbox') }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('Email') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('Inbox') }}</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            
            <div class="row">
                <div class="col-12">
                    <!-- Left sidebar -->
                    <div class="email-leftbar card">
                        <div class="d-grid">
                            <button type="button" class="btn btn-danger waves-effect waves-light compose-email" data-bs-toggle="modal" data-bs-target="#composemodal">
                                {{ __('Compose new Email') }}  
                            </button>
                        </div>
                        <h6 class="mt-4">{{ __('Chat') }}</h6>

                        <div class="mt-2">
                            <?php $displayedUsers = []; ?>
                            @foreach ($emails as $email)
                                @if (!in_array($email->user->id, $displayedUsers))
                                    <?php $displayedUsers[] = $email->user->id; ?>
                                    <?php $duplicateCount = 0; ?>
                                    @foreach ($emails as $otherEmail)
                                        @if ($otherEmail->user->id == $email->user->id)
                                            <?php $duplicateCount++; ?>
                                        @endif
                                    @endforeach
                                    <a href="#" class="d-flex">
                                        @if ($email->user->avatar)
                                            <img class="d-flex me-3 rounded-circle" src="{{ asset('storage/' . $email->user->avatar) }}" alt="Generic placeholder image" height="36">
                                        @else
                                            <img class="d-flex me-3 rounded-circle" src="https://i.pinimg.com/originals/06/3b/bf/063bbf0665eaf9c1730bccdc5c8af1b2.jpg" alt="Generic placeholder image" height="36">
                                        @endif
                                        <div class="flex-1 chat-user-box overflow-hidden">
                                            <p class="user-title m-0">{{$email->user->name}} @if ($duplicateCount > 1) <span class="badge bg-primary">{{ $duplicateCount }}</span> @endif </p>
                                            <p class="text-muted text-truncate">{{$email->subject}}</p>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <!-- End Left sidebar -->


                    <!-- Right Sidebar -->
                    <div class="email-rightbar mb-3">
                        
                        <div class="card">
                            <div class="btn-toolbar p-3" role="toolbar">
                                {{ __('sent mails') }}
                            </div>
                            <ul class="message-list">
                                <?php $displayedRecipients = []; ?>
                                @foreach ($emails as $email)
                                    @if (!in_array($email->recipient, $displayedRecipients))
                                        <?php
                                            $displayedRecipients[] = $email->recipient;
                                            $duplicateCount = collect($emails)->where('recipient', $email->recipient)->count();
                                        ?>
                                        <li>
                                            <div class="col-mail col-mail-1">
                                                <div class="checkbox-wrapper-mail">
                                                    <input type="checkbox" id="chk19">
                                                    <label class="form-label" for="chk19" class="toggle"></label>
                                                </div>
                                                <a href="#" class="title">{{$email->recipient}} @if ($duplicateCount > 1) <span class="badge bg-primary">{{ $duplicateCount }}</span> @endif</a><span class="star-toggle far fa-star"></span>
                                            </div>
                                            <div class="col-mail col-mail-2">
                                                <a href="#" class="subject">
                                                    {{$email->subject}}
                                                    
                                                    <span class="teaser">
                                                        {{$email->body}}
                                                    </span>
                                                </a>
                                                <div class="date" style="padding-right: 2px">{{ $email->sent_at->format('M d') }}</div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                            

                        </div> <!-- card -->

                        <div class="row">
                            
                            <div class="col-5">
                                <div class="btn-group float-end">
                                    <button type="button" class="btn btn-sm btn-success waves-effect"><i class="fa fa-chevron-left"></i></button>
                                    <button type="button" class="btn btn-sm btn-success waves-effect"><i class="fa fa-chevron-right"></i></button>
                                </div>
                            </div>
                        </div>

                    </div> 

                </div>

            </div><!-- End row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <!-- Modal -->
    <!-- Modal -->
<div class="modal fade" id="composemodal" >
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="composemodalTitle">{{ __('New Message') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="composeForm" action="{{route('admin.sendEmail')}} method="POST" ">
                    @csrf
                    <div class="mb-3">
                        <input type="email" class="form-control" name="title" placeholder="{{ __('To') }}">
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" name="subject" placeholder="{{ __('Subject') }}">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="message" placeholder="{{ __('Message') }}"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary" id="sendEmailBtn">{{ __('Send') }} <i class="fab fa-telegram-plane ms-1"></i></button>
            </div>
        </div>
    </div>
</div>

    
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © reda-elklie.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by reda elklie
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>


@endsection
