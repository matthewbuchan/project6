from django.shortcuts import render
from django.http import HttpResponse

# Create your views here.
def index(request):
    return render(request, 'solarpv/index.html')
    #return HttpResponse('Hi index!!')

def register(request):
    return render(request, 'solarpv/register.html')

def login(request):
    return render(request, 'solarpv/login.html')
