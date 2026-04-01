async function getPosts() {
    let res = await fetch('http://apitest/posts');
    let posts = await res.json();
    const postList = document.querySelector('.post-list')
    postList.innerHTML = '';
        posts.forEach((post) => {
        postList.innerHTML +=`
            <div class ="card" style="width: 18rem;">
                <div class = "card-body">
                    <h5 class = "card-title">${post.title}</h5>
                    <p class ="card-text">${post.body}</p>
                    <a href="#" class = "card-link">Подробнее</a>
                </div>
            </div>`;
    });
}

getPosts();