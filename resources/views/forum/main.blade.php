@extends('../layout/template')

@section('content')

<div class="container content-container">
    <div class="row mt-3">
        <div class="col-md-8">
            <div class="mb-3 d-flex justify-content-end addPostBtn">
                @if (session('hasLogin'))      
                <a href="/forum/post/add" class="btn btn-outline-dark">
                    <i class="bi bi-plus-circle-fill">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                          </svg>
                    </i>
                    Add Post
                </a>
                @endif
            </div>
            @foreach($post as $p)
            <div class="forum-section mb-5">
                <div class="opt-menu d-flex justify-content-end">
                    @if (session('hasLogin') && session('user_name') == $p->name)
                    <div class="dropdown">
                        <button class="btn btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                  </svg>
                            </i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <li>
                            <a class="dropdown-item" href="/forum/post/delete/{{$p->post_id}}">
                              <i class="bi bi-trash">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                                </i>
                                Delete
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/forum/post/edit/{{$p->post_id}}">
                                <i class="bi bi-pencil-square">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                      </svg>
                                </i>
                                Edit
                            </a>
                        </li>
                          {{-- <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                        </ul>
                      </div>
                    @endif
                </div>
                <h1>{{ $p->post_title}}</h1>
                <small><img src="" alt="">Post by {{ $p->name }} at {{ $p->created_at->format('d/m/Y H:i') }} WIB</small>
                @if ($p->post_img != null)
                <div class="post-img mt-3 mb-3">
                    <img src="/images/{{ $p->post_img }}" alt="" width="100">
                </div>
                @endif
                <p class="mt-3">{{ $p->post_desc}}</p>
                <div class="forum-action">
                    <i class="like-symbol bi bi-heart m-2" onclick="likeStateChange({{$p->post_id}}, {{$p->user_condition_like}}, event)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                        </svg> 
                        @if ($p->post_num_likes  == null )
                            0 Likes
                        @else
                            {{$p->post_num_likes}} Likes
                        @endif
                    </i>
                    <i class="bi bi-chat-left m-2" onclick="expandComment()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                        </svg>
                        {{-- @foreach ($commentCount as $cc) --}}
                            {{ $commentCount->where('to_post_id', $p->post_id)->count() }}
                        {{-- @endforeach --}}
                        <span> Comments</span>
                    </i>
                </div> 

                @if (session('hasLogin'))   
                <div class="form-floating mt-3">
                    <form action="/forum/comment/add" method="POST">
                        {{ csrf_field() }}
                        <textarea id="comment-text" class="form-control" name="comment_desc" placeholder="Leave a comment here" style="height: 100px"></textarea>
                        <input type="hidden" value="{{ $p->post_id }}" name="to_post_id">
                        {{-- <label for="floatingTextarea2">Comments</label> --}}
                        <div class="d-flex justify-content-end" >
                            <div class="btn-group btn-group-sm mt-3" role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-outline-dark">
                                    <i class="bi bi-card-image">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                        <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/>
                                        </svg>
                                    </i>
                                </button>
                                <button type="button" class="btn btn-outline-dark">
                                    <i class="bi bi-file-earmark-arrow-up-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16">
                                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/>
                                        </svg>
                                    </i>
                                </button>
                                <button onclick="sendCommentReply()" type="submit" class="btn btn-dark d-flex justify-content-end">
                                    <i class="bi bi-arrow-90deg-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14.854 4.854a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 4H3.5A2.5 2.5 0 0 0 1 6.5v8a.5.5 0 0 0 1 0v-8A1.5 1.5 0 0 1 3.5 5h9.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4z"/>
                                    </svg>
                                    </i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
                
                <div class="post-comment">
                        @foreach ($comment as $c) 
                            @if ($p->post_id == $c->to_post_id)
                            <div class="comment">
                                <hr>
                                <p>
                                    @foreach ($users as $u)
                                        <strong>{{ $u->id == $c->from_user_id ? $u->name : '' }}</strong>
                                    @endforeach
                                   : {{ $c->comment_desc }}
                                </p>
                                <small>{{ $c->created_at->format('d/m/Y H:i') }} WIB</small>
                                {{-- <hr> --}}
                            </div>
                            @endif
                        @endforeach
                    <small class="text-primary d-flex justify-content-end">See More Comments &#8594;</small>
                </div>
                
            </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <div class="sidebar-section">
                <h4>sidebar</h4>
                <ul>
                    <li>Point 1</li>
                    <li>Point 2</li>
                    <li>Point 3</li>
                    <li>Point 4</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<script>

    // let onLike
    const likeStateChange = (post_id, user_condition, event)  => {
        // onLike = !onLike
        console.log(user_condition)
        if(user_condition == false) {
                fetch('/add-like', {
                method : 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify ({
                    user_conditional : user_condition,
                    post_id : post_id
                })
            })
            .then(res => location.reload()).catch(err => console.log(err))

        } else {
                fetch('/unlike', {
                method : 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify ({
                    user_conditional : user_condition,
                    post_id : post_id
                })
            })
            .then(res => location.reload()).catch(err => console.log(err))
        }
        event.preventDefault();
    }
</script>

<style scoped>
    body {
        overflow-x: hidden;
    }

    .forum-section {
        box-shadow: 2px 2px 2px lightgrey;
        border-radius: 10px;
        text-align: left;
        padding: 5%;
    }

    .bi .bi-heart:hover {
        cursor: pointer;
    }

    .bi .bi-chat-left:hover {
        cursor: pointer;
    }

    .bi .bi-three-dots-vertical {
        cursor: pointer;
    }

    .sidebar-section {
        background-color: antiquewhite;
        border-left: solid 1px darkgray;
        text-align: left;
        padding: 5%;
    }

    .content-container {
        margin: auto;
        text-align: center;
    }
</style>


@endsection

<script>
    // Variable
    // commentBool = false
    // commentField = `
    //     <div class="form-floating">
    //     <textarea id="comment-text" class="form-control" placeholder="Leave a comment here" style="height: 100px"></textarea>
    //     <label for="floatingTextarea2">Comments</label>
    //     <div class="d-flex justify-content-end" >
    //     <div class="btn-group btn-group-sm mt-3" role="group" aria-label="Basic outlined example">
    //         <button type="button" class="btn btn-outline-dark">
    //             <i class="bi bi-card-image">
    //                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
    //                 <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
    //                 <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/>
    //                 </svg>
    //             </i>
    //         </button>
    //         <button type="button" class="btn btn-outline-dark">
    //             <i class="bi bi-file-earmark-arrow-up-fill">
    //                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16">
    //                 <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/>
    //                 </svg>
    //             </i>
    //         </button>
    //         <button onclick="sendCommentReply()" type="button" class="btn btn-dark d-flex justify-content-end">
    //             <i class="bi bi-arrow-90deg-right">
    //             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-right" viewBox="0 0 16 16">
    //             <path fill-rule="evenodd" d="M14.854 4.854a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 4H3.5A2.5 2.5 0 0 0 1 6.5v8a.5.5 0 0 0 1 0v-8A1.5 1.5 0 0 1 3.5 5h9.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4z"/>
    //             </svg>
    //             </i>
    //         </button>
    //     </div>
    //     </div>
    //     </div>`

    // Function
    // expandComment = () => {
    //         commentSection = document.querySelector('#comment-section')

    //         console.log(commentSection)
    //         commentBool = !commentBool
    
    //         if (commentBool) {
    //             commentSection.innerHTML = commentField
    //         } else {
    //             commentSection.innerHTML = ''
    //         }
    // }

    // sendCommentReply = async () => {
    //     let getComment = document.querySelector('#comment-text').value
    //     const csrfToken = document.head.querySelector("[name=csrf-token][content]").content
    //     console.log(getComment)

    //     let data = {
    //         comment: getComment
    //     }

    //     await fetch('/', {
    //         method: 'POST',
    //         body: JSON.stringify(data),
    //         headers: {
    //             "Content-type": "application/json",
    //             "X-CSRF-Token": csrfToken
    //         },
    //     }).then(response => {
    //         console.log(response)
    //     }).catch(err => {
    //         console.log(err)
    //     })
    // }

    // Flash Data
</script>