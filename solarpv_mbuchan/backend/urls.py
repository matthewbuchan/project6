from rest_framework import routers
from django.urls import path, include
from . import views

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
    path('API/', include(router.urls))
    ]