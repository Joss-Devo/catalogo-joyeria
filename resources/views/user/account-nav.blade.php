<ul class="account-nav">
            <li><a href="{{route('user.index')}}" class="menu-link menu-link_us-s">Cuenta</a></li>
            <li><a href="{{route('user.orders')}}" class="menu-link menu-link_us-s">Pedidos</a></li>
           <!-- <li><a href="account-address.html" class="menu-link menu-link_us-s">Addresses</a></li>
            <li><a href="account-details.html" class="menu-link menu-link_us-s">Account Details</a></li>
            <li><a href="account-wishlist.html" class="menu-link menu-link_us-s">Wishlist</a></li> -->
            
            <li>
            <form method="POST" action="{{route('logout')}}" id="logout-form">
                @csrf
                <a href="{{route('logout')}}" class="menu-link menu-link_us-s" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Salir</a>
            </form>
            </li>
          </ul>