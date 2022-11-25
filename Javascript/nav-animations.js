function burgerFunction()
{
    // Navigation Toggle
    document.getElementById('links-list').classList.toggle('active');
    
    // Links animation
    document.querySelectorAll('.links li').forEach((item, index) => 
    {
        if(item.style.animation)
        {
            item.style.animation = '';
        }
        else
        {
            item.style.animation = `slideInAnimation 0.5s ease forwards ${index/3 + 0.5}s`;
        }
    });

    // Burger Toggle Animation
    document.getElementById('burger').classList.toggle('change');
}