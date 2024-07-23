from django.utils.deprecation import MiddlewareMixin
from django.shortcuts import redirect
from django.shortcuts import render, HttpResponse
from utils.pymysql import Database
from utils import djclient

class DataMiddleware(MiddlewareMixin):
    def process_view(self, request, view_func, view_args, view_kwargs):
        if request.path != '/' and request.path != '/index/':
            return

        db = Database()
        results = db.query("SELECT * FROM users WHERE ip = %s", (djclient.getip(request), ))
        if results:
            request.session['user'] = {
                'username': results[0][2],
                'bmi': results[0][3],
                'bfm': results[0][4],
                'ideal_weight': results[0][5],
                'waist': results[0][6]
            }

            return render(request, 'display.html', request.session['user'])
        else:
            return

