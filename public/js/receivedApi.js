async function getPosts()
{
	let res = await fetch('https://jsonplaceholder.typicode.com/posts');
	let posts = await res.json();

	posts.forEach((post) => {
		document.querySelector('.api-post').innerHTML += `
			<div class="card" style="...">
				<div class="card-body">
					<h5 class="card-title">${post.title}</h5>
					<p class="card-text">${post.body}</p>
					<a href="#" class="card-link"></a>
				</div>
			</div>
		`	
	})
}

getPosts();
