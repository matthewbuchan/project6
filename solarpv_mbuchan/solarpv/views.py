from django.views.decorators.http import require_POST
from django.shortcuts import render, redirect
from django.views import View
from django.views.generic import ListView
from .models import User, Certificate
from .forms import RegisterForm, LoginForm, CertificateForm
from .filters import CertificateFilter

# Create your views here.
def index(request):
    return render(request, 'solarpv/index.html')
    

def registerform(request):
    user_list = User.objects.order_by('username')
    form = RegisterForm()
    context = { 'user_list' : user_list, 'form': form}
    return render(request, 'solarpv/register.html', context)

def registerformadd(request):
    form = RegisterForm(request.POST)
    if request.method == 'POST':
        #print('Printing registration', request.POST)
        form = RegisterForm(request.POST)
        if form.is_valid():
            form.save()    

    return redirect('registerform')

def loginform(request):
    user_list = User.objects.order_by('username')    
    context = { 'user_list' : user_list , 'LoginForm' : loginform }
    return render(request, 'solarpv/login.html', context)

def loginformadd(request):
    login_form = LoginForm(request.POST)
    # input_user = request.POST['username']
    # user_list = User.objects.get(username="input_user")
    
    if login_form.is_valid():
        
        new_user = LoginForm(username=request.POST)        
        new_user.save()

    return redirect('loginform')

# def certificateform(request):
#     certificate_list = Certificate.objects.all()
#     return render(request, 'solarpv/certificate.html',{'certificate_list':certificate_list})

class CertificateFormView(ListView):

    model = Certificate
    template_name = 'solarpv/certificate.html'

    def get_context_data(self, **kwargs):        
        context = super().get_context_data(**kwargs)
        context['filter'] = CertificateFilter(self.request.GET, queryset=self.get_queryset())
        return context