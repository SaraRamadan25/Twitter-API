import './bootstrap';

Echo.private('user.' + userId)
    .listen('FollowedUser', (e) => {
        alert(e.message);
    });
