Echo.private('chat.' + conversationId)
    .listen('MessageSent', (e) => {
        // Append the new message to the chat window
        let messageElement = document.createElement('div');
        messageElement.classList.add('msg', e.message.sender == userId ? 'me' : '');
        messageElement.innerHTML = `
            <img src='${e.message.sender_img}' alt="freelancer">
            <div class="text">
                <p>${e.message.content}</p>
                <span class="date">${e.message.created_at}</span>
            </div>
        `;
        document.querySelector('.body').appendChild(messageElement);
    });