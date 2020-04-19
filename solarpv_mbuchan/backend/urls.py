from rest_framework import routers
from django.urls import path, include
from . import views

router = routers.DefaultRouter()
router.register('Product',views.ProductView)
router.register('Certificate',views.CertificateView)
router.register('Service',views.ServiceView)

urlpatterns = [
    path('', include(router.urls))
    ]
