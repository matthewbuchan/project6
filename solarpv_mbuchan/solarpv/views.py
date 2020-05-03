from django.views.decorators.http import require_POST
from django.shortcuts import render, redirect, reverse
from django.views import View
from django.views.generic import ListView
#from .models import User, Certificate
from .forms import RegisterForm, LoginForm, CertificateForm
from .filters import CertificateFilter
from django.http import HttpResponse

from rest_framework import viewsets, generics
from .models import TestSequence, Product, Client, TestStandard, Location, User, Certificate, Service, PerformanceData
from .serializers import TestSequenceSerializer,ProductSerializer,ClientSerializer,TestStandardSerializer,LocationSerializer,UserSerializer,CertificateSerializer,ServiceSerializer,PerformanceDataSerializer




# Create your views here.

def index(request):
    return render(request, 'solarpv/index.html')


def registerform(request):
    user_list = User.objects.order_by('username')
    form = RegisterForm()
    context = {'user_list': user_list, 'form': form}
    return render(request, 'solarpv/register.html', context)


def registerformadd(request):
    form = RegisterForm(request.POST)
    if request.method == 'POST':
        form = RegisterForm(request.POST)
        if form.is_valid():
            form.save()

    return redirect('registerform')


def loginform(request):
    if request.method == 'POST':
        form = LoginForm(request.POST)
        if form.is_valid():
                userinput = form.cleaned_data['username']
                validuser = User.objects.filter(username=userinput).exists()
                if validuser:
                    if userinput == "Admin":
                        return redirect('/admin/')
                    else:
                        return redirect('/API')
    else:
        form = LoginForm()
        return render(request, 'solarpv/login.html', {'form': form})
    
    return redirect('loginform')


class CertificateFormView(ListView):

    model = Certificate
    template_name = 'solarpv/certificate.html'

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['filter'] = CertificateFilter(
            self.request.GET, queryset=self.get_queryset())
        return context


#SERIALIZERS

class TestSequenceView(viewsets.ModelViewSet):
    queryset = TestSequence.objects.all()
    serializer_class = TestSequenceSerializer

class ProductView(viewsets.ModelViewSet):
    queryset = Product.objects.all()
    serializer_class = ProductSerializer

class ClientView(viewsets.ModelViewSet):
    queryset = Client.objects.all()
    serializer_class = ClientSerializer

class TestStandardView(viewsets.ModelViewSet):
    queryset = TestStandard.objects.all()
    serializer_class = TestStandardSerializer

class LocationView(viewsets.ModelViewSet):
    queryset = Location.objects.all()
    serializer_class = LocationSerializer

class UserView(viewsets.ModelViewSet):
    queryset = User.objects.all()
    serializer_class = UserSerializer

class CertificateView(viewsets.ModelViewSet):
    queryset = Certificate.objects.all()
    serializer_class = CertificateSerializer                       

class ServiceView(viewsets.ModelViewSet):
    queryset = Service.objects.all()
    serializer_class = ServiceSerializer

class PerformanceDataView(viewsets.ModelViewSet):
    queryset = PerformanceData.objects.all()
    serializer_class = PerformanceDataSerializer