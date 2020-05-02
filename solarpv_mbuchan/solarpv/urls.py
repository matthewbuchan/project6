from django.urls import path
from . import views

urlpatterns = [
    path('', views.index, name='index'),
    path('registerform/', views.registerform, name='registerform'),
    path('registerformadd/', views.registerformadd, name='registerformadd'),
    path('loginform/', views.loginform, name='loginform'),
    path('loginformadd/', views.loginformadd, name='loginformadd'),
    # path('certificateform/', views.certificateform, name='certificateform'),
    path('certificateform/', views.CertificateFormView.as_view(), name='certificateform'),
]