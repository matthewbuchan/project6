from django.shortcuts import render
from .models import TestSequence, Product, Client, TestStandard, Location, User, Certificate, Service, PerformanceData


# Create your views here.
def index(request):
    return render(request, 'solarpv/index.html')
    #return HttpResponse('Hi index!!')

def register(request):
    return render(request, 'solarpv/register.html')

def login(request):
    return render(request, 'solarpv/login.html')

def certificate(request):
    certificate_list = Certificate.objects.order_by('issuedate')

    context = {'certificate_list' : certificate_list}

    return render(request, 'solarpv/certificate.html', context)