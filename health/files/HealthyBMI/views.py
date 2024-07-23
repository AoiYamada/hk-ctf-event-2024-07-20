from utils import indicators
from django.shortcuts import render
from django.shortcuts import redirect
from utils.pymysql import Database
from utils import djclient

def index(request):
    if 'user' in request.session:
        return render(request, 'display.html', request.session['user'])
    else:
        return render(request, 'submit.html', {})

def calculate(request):
    if 'user' in request.session:
        return render(request, 'display.html', request.session['user'])
    else:
        if request.method == 'GET':
            return render(request, 'submit.html', {})
        if request.method == 'POST':
            db = Database()
            username = request.POST.get('username')
            weight, height, age, waist = request.POST.get('weight'), request.POST.get('height'), request.POST.get('age'), request.POST.get('waist')
            bmi, bfm, ideal_weight, waist = indicators.calculate(int(weight), int(height), int(age), int(waist))
            request.session['user'] = {
                'username': username,
                'bmi': bmi,
                'bfm': bfm,
                'ideal_weight': ideal_weight,
                'waist': waist
            }

            results = db.query("SELECT * FROM users WHERE ip = %s", (djclient.getip(request), ))
            if results:
                update = "The health index has been updated, currently logged in:{user}, Update time:" + request.POST.get('time')
                db.update(
                    "UPDATE users SET username = %s, bmi = %s, bfm = %s, ideal_weight = %s, waist = %s WHERE ip = %s",
                    (username, bmi, bfm, ideal_weight, waist, djclient.getip(request))
                )
                return render(request, 'display.html', {
                    'username': username,
                    'bmi': bmi,
                    'bfm': bfm,
                    'ideal_weight': ideal_weight,
                    'waist': waist,
                    'update': update.format(user=request.user)
                })
            else:
                db.insert(
                    "INSERT INTO users (ip, username, bmi, bfm, ideal_weight, waist) VALUES (%s, %s, %s, %s, %s, %s)",
                    (djclient.getip(request), username, bmi, bfm, ideal_weight, waist)
                )
                return render(request, 'display.html', request.session['user'])

def reset(request):
    if request.method == 'GET':
        request.session.clear()
        return render(request, 'submit.html', {})