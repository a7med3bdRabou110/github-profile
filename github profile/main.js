const APIURL = "https://api.github.com/users/" ; 
const main   = document.querySelector("#main") ; 
const search   = document.querySelector("#search") ; 
const form   = document.querySelector("#form") ; 

getUser("a7med3bdRabou110") ; 
async function getUser(username) {
    const repo = await fetch(APIURL + username) ; 
    const repoData  = await repo.json();
    getRepos(username) ; 
    createUserCard(repoData);
    getRepos(username)
}

async function getRepos(username) {
    const repo = await fetch(APIURL + username + "/repos") ; 
    const repoData = await repo.json() ; 
}

async function createUserCard(user) {
    const cardHTML = `
        <div class="card">
            <div>
                <img class="avatar" src="${user.avatar_url}" alt = "${user.name}" />
            </div>

            <div class="user_info">
                <h2>${user.name}</h2>
                <p>${user.bio}</p>
                <ul class="info">
                    <li>
                        ${user.followers}
                        <strong>
                            Followers
                        </strong>
                    </li>
                    <li>
                        ${user.followers}
                        <strong>
                            Followers
                        </strong>
                    </li>
                    <li>
                        ${user.public_repos}
                        <strong>
                            Repos
                        </strong>
                    </li>
                </ul>
            </div>

        </div>        
    
    ` ; 

    main.innerHTML = cardHTML ; 
}


function addReposToCard(repos){

    const reposEl = document.querySelector("#repos") ; 

    repos
        .sort((a,b) => b.stargazer_count - a.stargazer_count)  
        .slice(0,10) 
        .forEach(repo => {
            const repoEl = document.createComment("a") ; 
            repoEl.classList.add("repo") ; 
            repoEl.target = "_blank" ; 
            repoEl.innerText = repo.name ; 
            reposEl.appendChild(repoEl) ;
        })

}


form.addEventListener("submit" ,  (e) => {
    e.preventDefault();
    const user = search.nodeValue;
    if(user) {
        getUser(user) ; 

        search.nodeValue(" ") ; 
    }
})