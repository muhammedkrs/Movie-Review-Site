var player;
function onYouTubeIframeAPIReady() {
    player = new YT.Player('youtube-video', {
        height: '450',
        width: '600',
       
        videoId: 'xLD1UQnqLhU',
        playerVars: {
            'autoplay': 0,
            'controls': 1,
            'rel': 0,
            'showinfo': 0,
        },
        events: {
            'onReady': onPlayerReady,
        },
    });
}

function onPlayerReady(event) {
    event.target.playVideo();
}
var commentSection = document.getElementById("comment-section");
var commentForm = document.getElementById("comment-form");
var commentInput = document.getElementById("comment-input");

commentForm.addEventListener("submit", function (event) {
    event.preventDefault();

    var commentContent = commentInput.value.trim();

    if (commentContent !== "") {
        addComment(commentContent);
        commentInput.value = "";
    }
});

function addComment(content) {
    var newComment = document.createElement("div");
    newComment.classList.add("comment");
    newComment.innerHTML = `
    <p class="comment-content">${content}</p>
  `;
    commentSection.appendChild(newComment);

    commentSection.scrollTop = commentSection.scrollHeight;
}

