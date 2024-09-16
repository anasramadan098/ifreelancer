

document.querySelectorAll('.sureBtn').forEach(btn => {
    btn.addEventListener('click' , (event) =>  {

        event.preventDefault();
        const form  = document.querySelector('.sureForm');
        
        
        const overlay = document.createElement('div');
        overlay.classList.add('sure-overlay');
    
        const holder = document.createElement('div');
        holder.classList.add('holder');
    
    
        const message = document.createElement('p');
        message.textContent = 'Are you sure?';
        holder.appendChild(message);
    
    
        const confirmButton = document.createElement('button');
        confirmButton.textContent = 'Yes';
        confirmButton.classList.add('btn');
        confirmButton.addEventListener('click', () => {
            if (form) {
                form.submit();
            } else {
                window.location.href = btn.href;
            }
            overlay.remove();
        });
        holder.appendChild(confirmButton);
    
    
        const cancelButton = document.createElement('button');
        cancelButton.classList.add('btn');
        cancelButton.textContent = 'No';
        cancelButton.addEventListener('click', () => {
            overlay.remove();
        });
    
        holder.appendChild(cancelButton);
    
    
        overlay.appendChild(holder);
    
        document.body.appendChild(overlay);
    })
    
    
})