def Hello():
    return render_template("index.html")
 
@app.route('/name.php', methods=['POST'])
def Name():
    name = request.form['name']
    for blacklist in blacklists:
        if blacklist in str(name).lower():
            template = '<h2>Good Job %s!</h2>' % "nooo"
            return render_template_string(template)
    template = '<h2>Good Job %s!</h2>' % name