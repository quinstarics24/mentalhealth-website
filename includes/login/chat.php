<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time Chat</title>
   <style>/* style.css */
.chat-container {
    width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #f9f9f9;
}

.chat-box {
    height: 300px;
    overflow-y: scroll;
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    background-color: #fff;
}

.message {
    margin-bottom: 10px;
}

.message .sender {
    font-weight: bold;
}

.message .timestamp {
    font-size: 0.8em;
    color: gray;
    margin-left: 5px;
}

textarea {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    resize: none;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #218838;
}
</style>
</head>
<body>

<!-- Chat Interface -->
<div class="chat-container">
    <div id="chat-box" class="chat-box">
        <!-- Messages will appear here -->
    </div>
    
    <textarea id="message" placeholder="Type your message..."></textarea>
    <button onclick="sendMessage()">Send</button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// Chat box updates every 2 seconds
setInterval(function() {
    loadMessages();
}, 2000);

// Function to load messages
function loadMessages() {
    $.ajax({
        url: 'load_messages.php',
        method: 'GET',
        success: function(data) {
            $('#chat-box').html(data);
        }
    });
}

// Function to send a message
function sendMessage() {
    var message = $('#message').val();
    $.ajax({
        url: 'send_message.php',
        method: 'POST',
        data: { message: message, receiver_id: 1 },  // Example: 1 is the receiver ID (e.g., admin)
        success: function(response) {
            $('#message').val('');  // Clear the message input
            loadMessages();  // Reload messages after sending
        }
    });
}
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
