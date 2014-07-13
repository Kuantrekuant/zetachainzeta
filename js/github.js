var GitHubRepo = Gh3.Repository.extend({//instance members
    constructor : function(name, user) {
	GitHubRepo.__super__.constructor.call(this, name, user);
	GitHubRepo.allRepo.push(this);
    }
},{ //Static members
    allRepo : [],
    each : function (callback) {
	_.each(GitHubRepo.allRepo, function (repo) {
	    callback(repo);
	})
    }
});

var me = new Gh3.User("thez3ro")
,	repositories = $("#repo");

var site = new GitHubRepo("thez3ro.github.io",me)
,   fuku = new GitHubRepo("fuku",me)
,   apk2java = new GitHubRepo("apk2java-linux",me);

GitHubRepo.each(function (repo) {
    repo.fetch(function (err, resRepo) {

	if(err) {
	    throw "outch ..."
	}

	console.log(resRepo);
	repositories.append(
		$('<div class="col-lg-4">').append(
			$('<h2>').append(resRepo.name),
			$('<p>').append(resRepo.description+" : "+resRepo.language),
			$('<p>').append('<a class="btn btn-primary" href="'+resRepo.html_url+'">View on GitHub &raquo;</a>')
		)
	);
    });
})

	