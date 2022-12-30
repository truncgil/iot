<?php use App\Translate; ?>

<?php use App\Types; ?>

<?php $types = Types::whereNull("kid")->orderBy("s","ASC")->get(); ?>

 <div class="content-side content-side-full">

                    

                    <ul class="nav-main">

                        <li>

                            <a class="active" href="{{url('admin/')}}"><i class="si si-cup"></i><span

                                    class="sidebar-mini-hide">{{__('Dashboard')}}</span></a>

                        </li>

<?php $level = str_slug(u()->level); ?>
@if(View::exists("admin.inc.menu.$level"))
	@include("admin.inc.menu.$level")
@endif
	
					

						<li class="nav-main-heading d-none"><span class="sidebar-mini-visible">UI</span><span

                                class="sidebar-mini-hidden">{{__('Content Types')}}</span></li>

								

						 @foreach($types AS $c)

						

							@if(in_array($c->title,$permissions) || in_array("ALL PRIVILEGES",$permissions))

								<li>

							<?php $alt = Types::where("kid",$c->slug)->get(); ?>

									<a  <?php if(varmi($alt)) { ?>class="nav-submenu" data-toggle="nav-submenu"<?php } ?>  href="{{ url('admin/types/'. $c->slug) }}"><i class="fa fa-{{$c->icon}}"></i><span>{{__($c->title)}}</span></a>

									<?php  if(varmi($alt)) { ?>

								

									<ul>

									<?php foreach($alt AS $a) { ?>

									@if(in_array($c->title,$permissions) || in_array("ALL PRIVILEGES",$permissions))
										<li><a href="{{ url('admin/types/'. $a->slug) }}">{{$a->title}}</a></li>

									@endif

									<?php } ?>
									</ul>

									<?php } ?>

								</li>

							@endif

							

						@endforeach

						@if(in_array("users",$permissions))

					

                        <li>

                            <a class="nav-submenu" href="{{url('admin/users')}}"><i class="si si-users"></i><span

                                    class="sidebar-mini-hide">{{__('Users')}}</span></a>                        

                        </li>



						@endif

                       
						@if(in_array("new",$permissions))

						<li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span

                                class="sidebar-mini-hidden">{{__('Content Management')}}</span></li>

                        <li>

                            <a class="nav-submenu" href="{{url('admin/new/contents')}}"><i class="si si-grid"></i><span

                                    class="sidebar-mini-hide">{{__("Contents")}}</span></a>

                          

                        </li>

                        <li>

                            <a class="nav-submenu" href="{{ url('admin/new/types') }}"><i

                                    class="si si-layers"></i><span class="sidebar-mini-hide">{{__('Types')}}</span></a>

                            

                        </li>

                        <li>

                            <a class="nav-submenu" href="{{url('admin/fields')}}"><i class="si si-list"></i><span

                                    class="sidebar-mini-hide">{{__('Columns')}}</span></a>

                           

                        </li>

						@endif

						

						@if(in_array("languages",$permissions))

                        <li class="nav-main-heading d-none"><span class="sidebar-mini-visible">UI</span><span

                                class="sidebar-mini-hidden">{{__('Language Settings')}}</span></li>

							

							<?php 	$diller = explode(",","en,tr"); foreach($diller AS $d) { ?>

							<li class="d-none">

									<a href="{{ url('admin/languages/'. $d) }}"><i class="fa fa-language"></i><span>{{__($d)}}</span></a>

								</li>

							<?php } ?>

						@endif

                    </ul>



                </div>