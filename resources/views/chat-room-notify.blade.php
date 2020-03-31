<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.5.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.5.2/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.5.2/firebase-database.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyB3zVkaBPfUJjHbY_lez6i1Tymz4Pm1hC0",
        authDomain: "just-training-66adc.firebaseapp.com",
        databaseURL: "https://just-training-66adc.firebaseio.com",
        projectId: "just-training-66adc",
        storageBucket: "just-training-66adc.appspot.com",
        messagingSenderId: "977465953999",
        appId: "1:977465953999:web:a66069e2b71b7b103c31ba",
        measurementId: "G-9R4FDJ7Y71"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    var database = firebase.database();

    parse = snapshot => {
        const {timestamp: numberStamp, text, user, group_id} = snapshot.val();
        const {key: _id} = snapshot;
        const timestamp = new Date(numberStamp);
        const message = {
            group_id,
            _id,
            timestamp,
            text,
            user,
        };
        return message;
    };

    var starCountRef = firebase.database().ref('messages').limitToLast(1);
    starCountRef.on('child_added', function(snapshot) {
        console.log(snapshot.val());
        var APP_URL = {!! json_encode(url('/')) !!};
        $.ajax({
            data: {group_id:snapshot.val().group_id,text:snapshot.val().text,user:snapshot.val().user.name},
            url: APP_URL+'/services/create/chat-room-notification',
            type: 'POST',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function(response){
                console.log(response);
            }
        })
        //updateStarCount(postElement, snapshot.val());
    });
    //console.log(starCountRef);
</script>
