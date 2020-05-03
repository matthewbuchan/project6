from django.urls import path, include
from . import views
from backend import views as backend_views

from rest_framework import routers
#from django.urls import path, include
#from . import views

router = routers.DefaultRouter()
router.register('TestSequence', views.TestSequenceView)
router.register('Product',views.ProductView)
router.register('Client',views.ClientView)
router.register('TestStandard',views.TestStandardView)
router.register('Location',views.LocationView)
router.register('User',views.UserView)
router.register('Certificate',views.CertificateView)
router.register('Service',views.ServiceView)
router.register('PerformanceData',views.PerformanceDataView)




urlpatterns = [
    path('', views.index, name='index'),
    path('registerform/', views.registerform, name='registerform'),
    path('registerformadd/', views.registerformadd, name='registerformadd'),
    path('loginform/', views.loginform, name='loginform'),
    path('certificateform/', views.CertificateFormView.as_view(),name='certificateform'),
    path('API/', include(router.urls), name='userapi'),
]
