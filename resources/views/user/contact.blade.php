@extends('layout.UserLayout')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <!-- Cột trái: Form liên hệ -->
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">📬 Contact With Me</h3>

                        {{-- Thông báo --}}
                        @if (session('success'))
                            <div class="alert alert-success" id="alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger" id="alert-error">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Form --}}
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" name="name" class="form-control" required
                                    placeholder="Enter your name" value="{{ old('name', Auth::user()->fullname ?? '') }}">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Your Email</label>
                                <input type="email" name="email" class="form-control" required
                                    placeholder="Enter your email" value="{{ Auth::user()->email ?? '' }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea name="message" rows="5" class="form-control" required placeholder="Your message...">{{ old('message') }}</textarea>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- Cột phải: Tin nhắn admin gửi về -->
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-4 h-100">
                    <div class="card-body" style="max-height: 500px; overflow-y: auto;">
                        <h4 class="card-title text-center mb-4">📨 Tin nhắn từ Admin</h4>

                        {{-- Lặp qua danh sách các tin nhắn người dùng đã gửi --}}
                        @forelse ($contacts as $contact)
                            <div class="mb-4 border rounded-3 p-3 bg-light">

                                {{-- Tin nhắn người dùng --}}
                                <div class="mb-2">
                                    <span class="fw-bold text-primary">Bạn:</span>
                                    <span>{{ $contact->message }}</span><br>
                                    <small class="text-muted">{{ $contact->created_at->format('d/m/Y H:i') }}</small>
                                </div>

                                {{-- Lặp qua danh sách các phản hồi từ admin --}}
                                @forelse ($contact->replies as $reply)
                                    <div class="mt-2">
                                        <span class="fw-bold text-success">Admin:</span>
                                        <span>{{ $reply->reply }}</span><br>
                                        <small class="text-muted">{{ $reply->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                @empty
                                    {{-- Nếu chưa có phản hồi --}}
                                    <div class="text-muted mt-2">⏳ Chưa có phản hồi từ admin.</div>
                                @endforelse

                            </div>
                        @empty
                            {{-- Nếu người dùng chưa gửi tin nhắn nào --}}
                            <div class="text-center text-muted fs-5">📭 Bạn chưa gửi tin nhắn nào.</div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
    @if (session('success') || $errors->any())
        <script>
            setTimeout(function() {
                var alertSuccess = document.getElementById('alert-success');
                if (alertSuccess) alertSuccess.style.display = 'none';
                var alertError = document.getElementById('alert-error');
                if (alertError) alertError.style.display = 'none';
            }, 2000);
        </script>
    @endif
@endsection
